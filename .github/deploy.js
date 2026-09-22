const ftp = require("basic-ftp");
const fs = require("fs");
const path = require("path");

async function deploy() {
    const client = new ftp.Client();
    client.ftp.verbose = true;
    client.ftp.timeout = 60000;

    const server = process.env.CPANEL_FTP_SERVER;
    const user = process.env.CPANEL_FTP_USERNAME;
    const password = process.env.CPANEL_FTP_PASSWORD;

    if (!server || !user || !password) {
        console.error("Error: Missing FTP credentials in environment variables.");
        process.exit(1);
    }

    try {
        console.log(`Connecting to FTPS ${server}:21 as ${user}...`);
        await client.access({
            host: server,
            user: user,
            password: password,
            port: 21,
            secure: true,
            secureOptions: {
                rejectUnauthorized: false
            }
        });

        console.log("Connected successfully to cPanel FTP!");
        const currentDir = await client.pwd();
        console.log("Initial remote directory:", currentDir);

        const list = await client.list();
        const names = list.map(item => item.name);
        console.log("Items in current directory:", names);

        // Check if we need to enter public_html
        const isCpanelHome = names.includes("mail") || names.includes("etc") || names.includes("public_ftp");
        if (isCpanelHome && names.includes("public_html")) {
            console.log("Navigating into public_html/...");
            await client.cd("public_html");
        } else if (names.includes("public_html") && !names.includes("app")) {
            console.log("Navigating into public_html/...");
            await client.cd("public_html");
        } else {
            console.log("Already inside target web root.");
        }

        console.log("Deploy target directory:", await client.pwd());

        // 1. Upload app/ directory (views, models, controllers, configs)
        console.log("--> Uploading app/ directory...");
        await client.uploadFromDir("app", "app");

        // 2. Upload public/ directory (assets, css, js, images)
        console.log("--> Uploading public/ directory...");
        await client.uploadFromDir("public", "public");

        // 3. Upload system/ directory if needed
        if (fs.existsSync("system")) {
            console.log("--> Ensuring system/ directory is synced...");
            await client.uploadFromDir("system", "system");
        }

        // 4. Upload root controllers and configuration
        console.log("--> Uploading root entrypoint and routing files...");
        if (fs.existsSync("index.php")) {
            await client.uploadFrom("index.php", "index.php");
        }
        if (fs.existsSync(".htaccess")) {
            await client.uploadFrom(".htaccess", ".htaccess");
        }
        if (fs.existsSync("spark")) {
            await client.uploadFrom("spark", "spark");
        }

        console.log("==================================================");
        console.log(">>> Solveta cPanel Deployment Completed 100%! <<<");
        console.log("==================================================");
    } catch (err) {
        console.error("Deployment failed with error:", err);
        process.exit(1);
    } finally {
        client.close();
    }
}

deploy();

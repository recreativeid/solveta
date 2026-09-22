const ftp = require("basic-ftp");
const fs = require("fs");
const path = require("path");

async function deploy() {
    const client = new ftp.Client();
    client.ftp.verbose = true;
    client.ftp.timeout = 120000;

    const server = (process.env.CPANEL_FTP_SERVER || "").trim();
    const user = (process.env.CPANEL_FTP_USERNAME || "").trim();
    const password = (process.env.CPANEL_FTP_PASSWORD || "").trim();

    if (!server || !user || !password) {
        console.error("Error: Missing FTP credentials in environment variables.");
        process.exit(1);
    }

    try {
        let connected = false;
        try {
            console.log(`[1] Attempting FTPS (secure: true) to ${server}:21 as ${user}...`);
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
            connected = true;
            console.log("Successfully connected via FTPS!");
        } catch (secErr) {
            console.warn("FTPS connection failed, falling back to plain FTP:", secErr.message);
        }

        if (!connected) {
            console.log(`[2] Attempting standard FTP (secure: false) to ${server}:21 as ${user}...`);
            await client.access({
                host: server,
                user: user,
                password: password,
                port: 21,
                secure: false
            });
            console.log("Successfully connected via standard FTP!");
        }

        const currentDir = await client.pwd();
        console.log("Initial remote directory:", currentDir);

        const list = await client.list();
        const names = list.map(item => item.name);
        console.log("Items in initial directory:", names);

        // Check if we are in cPanel home directory
        const isCpanelHome = names.includes("mail") || names.includes("etc") || names.includes("public_ftp");
        if (isCpanelHome && names.includes("public_html")) {
            console.log("Navigating into public_html/...");
            await client.cd("public_html");
        } else if (names.includes("public_html") && !names.includes("app")) {
            console.log("Navigating into public_html/...");
            await client.cd("public_html");
        } else {
            console.log("Already in target web root directory.");
        }

        console.log("Target directory for deployment:", await client.pwd());

        // 1. Upload app/ directory (CodeIgniter 4 application)
        console.log("--> Uploading app/ directory...");
        await client.uploadFromDir("app", "app");

        // 2. Upload public/ directory (Assets, CSS, JS, Images)
        console.log("--> Uploading public/ directory...");
        await client.uploadFromDir("public", "public");

        // 3. Upload system/ directory if present
        if (fs.existsSync("system")) {
            console.log("--> Uploading system/ directory...");
            await client.uploadFromDir("system", "system");
        }

        // 4. Upload root controllers
        console.log("--> Uploading root entrypoint files...");
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
        console.log(">>> SOLVETA DEPLOYMENT TO CPANEL SUCCEEDED! <<<");
        console.log("==================================================");
    } catch (err) {
        console.error("FATAL: Deployment failed:", err);
        process.exit(1);
    } finally {
        client.close();
    }
}

deploy();

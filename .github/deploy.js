const ftp = require("basic-ftp");
const fs = require("fs");
const path = require("path");

async function runUpload(client) {
    const list = await client.list();
    const names = list.map(item => item.name);
    console.log("Items in initial remote directory:", names.slice(0, 15));

    // Check if we are in cPanel home directory
    const isCpanelHome = names.includes("mail") || names.includes("etc") || names.includes("public_ftp");
    if (isCpanelHome && names.includes("public_html")) {
        console.log("Entering public_html/...");
        await client.cd("public_html");
    } else if (names.includes("public_html") && !names.includes("app")) {
        console.log("Entering public_html/...");
        await client.cd("public_html");
    } else {
        console.log("Already inside target web root.");
    }

    const currentDir = await client.pwd();
    console.log("Current remote directory:", currentDir);

    const pubList = await client.list();
    console.log("=== CONTENTS OF REMOTE DIRECTORY (" + currentDir + ") ===");
    for (const item of pubList) {
        console.log(` - ${item.name} (${item.isDirectory ? 'DIR' : 'FILE'}, ${item.size} bytes)`);
    }

    // 1. Upload app/ directory (CodeIgniter 4 application views, models, controllers)
    console.log("--> Uploading app/ directory...");
    await client.uploadFromDir("app", "app");

    // 2. Upload public/ directory (Assets, CSS, JS, Images, Logo)
    console.log("--> Uploading public/ directory...");
    await client.uploadFromDir("public", "public");

    // Also sync assets directly to assets/
    console.log("--> Syncing assets directly to assets/...");
    await client.uploadFromDir("public/assets", "assets");

    // 3. Upload system/ directory if present
    if (fs.existsSync("system")) {
        console.log("--> Uploading system/ framework directory...");
        await client.uploadFromDir("system", "system");
    }

    // 4. Upload root controllers and configuration
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
    console.log(">>> SOLVETA DEPLOYMENT TO CPANEL SUCCEEDED 100%! <<<");
    console.log("==================================================");
}

async function deploy() {
    const server = (process.env.CPANEL_FTP_SERVER || "").trim();
    const user = (process.env.CPANEL_FTP_USERNAME || "").trim();
    const password = (process.env.CPANEL_FTP_PASSWORD || "").trim();

    if (!server || !user || !password) {
        console.error("Error: Missing FTP credentials in environment variables.");
        process.exit(1);
    }

    // Attempt 1: Standard plain FTP (avoids ProFTPD TLS 1.3 alert decode bug)
    console.log(`[Attempt 1] Trying standard FTP to ${server}:21 as ${user}...`);
    let client = new ftp.Client();
    client.ftp.verbose = false;
    client.ftp.timeout = 180000;

    let success = false;
    try {
        await client.access({
            host: server,
            user: user,
            password: password,
            port: 21,
            secure: false
        });
        console.log("Connected via standard FTP! Starting file upload...");
        await runUpload(client);
        success = true;
    } catch (err1) {
        console.warn("Standard FTP failed or required TLS:", err1.message);
        client.close();
    }

    if (success) {
        client.close();
        return;
    }

    // Attempt 2: FTPS with TLS 1.2 forced (fixes TLS 1.3 alert decode bug)
    console.log(`[Attempt 2] Trying FTPS (enforcing TLS 1.2) to ${server}:21 as ${user}...`);
    client = new ftp.Client();
    client.ftp.verbose = false;
    client.ftp.timeout = 180000;

    try {
        await client.access({
            host: server,
            user: user,
            password: password,
            port: 21,
            secure: true,
            secureOptions: {
                rejectUnauthorized: false,
                minVersion: "TLSv1.2",
                maxVersion: "TLSv1.2"
            }
        });
        console.log("Connected via FTPS (TLS 1.2)! Starting file upload...");
        await runUpload(client);
        success = true;
    } catch (err2) {
        console.error("FTPS TLS 1.2 failed:", err2);
        process.exit(1);
    } finally {
        client.close();
    }
}

deploy();

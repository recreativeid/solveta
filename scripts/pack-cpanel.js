const { execSync } = require('child_process');
const fs = require('fs');
const path = require('path');

const rootDir = path.resolve(__dirname, '..');
const outDir = path.join(rootDir, 'out');
const zipFile = path.join(rootDir, 'solveta-cpanel.zip');

if (!fs.existsSync(outDir)) {
  console.error('Folder out/ tidak ditemukan. Jalankan npm run build terlebih dahulu.');
  process.exit(1);
}

// Pastikan .htaccess ada di out/
const htaccessSrc = path.join(rootDir, 'public', '.htaccess');
const htaccessDest = path.join(outDir, '.htaccess');
if (fs.existsSync(htaccessSrc)) {
  fs.copyFileSync(htaccessSrc, htaccessDest);
  console.log('✓ .htaccess tersalin ke out/.htaccess');
}

console.log('Sedang membuat file zip solveta-cpanel.zip...');
if (fs.existsSync(zipFile)) {
  fs.unlinkSync(zipFile);
}

try {
  // Compress isi folder out/ langsung ke dalam root zip (bukan subfolder out/)
  const psCmd = `powershell -ExecutionPolicy Bypass -Command "Compress-Archive -Path '${outDir}\\*' -DestinationPath '${zipFile}' -Force"`;
  execSync(psCmd, { stdio: 'inherit' });
  const stat = fs.statSync(zipFile);
  console.log(`✓ BERHASIL! File zip siap diupload ke cPanel:`);
  console.log(`  Lokasi: ${zipFile}`);
  console.log(`  Ukuran: ${(stat.size / 1024 / 1024).toFixed(2)} MB`);
} catch (e) {
  console.error('Gagal membuat zip:', e.message);
}

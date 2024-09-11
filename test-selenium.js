import { Builder, By, until } from 'selenium-webdriver';
import chalk from 'chalk';


async function smoothScrollToFooterAndBack(driver) {
    // Scroll ke footer dengan efek halus
    let footer = await driver.wait(until.elementLocated(By.tagName('footer')), 10000);
    await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'end' });", footer);

    // Tunggu sejenak agar scroll ke footer sepenuhnya selesai
    await driver.sleep(2000);

    // Scroll kembali ke atas dengan efek halus
    await driver.executeScript("window.scrollTo({ top: 0, behavior: 'smooth' });");

    // Tunggu sejenak agar scroll ke atas sepenuhnya selesai
    await driver.sleep(2000);
}

async function testBeranda(driver) {
    console.log("===================================");
    console.log(chalk.grey("Testing 'Beranda' menu..."));

    try {
        // Tunggu halaman awal dimuat dan verifikasi URL halaman beranda
        let url = await driver.getCurrentUrl();
        if (url === 'http://127.0.0.1:8000/') {
            console.log(chalk.green("Beranda menu test passed!"));
        } else {
            console.log(chalk.red("Beranda menu test failed!"));
        }

        // Temukan elemen anggota tim dan scroll ke elemen
        let teamMemberLink = await driver.wait(until.elementLocated(By.css('.team-member')), 10000);
        await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'center' });", teamMemberLink);

        // Tunggu overlay menghilang
        await driver.sleep(2000);

        // Klik anggota tim menggunakan JavaScript sebagai alternatif
        await driver.executeScript("arguments[0].click();", teamMemberLink);

        // Tunggu halaman detail tim dimuat
        await driver.sleep(2000);

        // Verifikasi URL halaman detail tim
        let detailUrl = await driver.getCurrentUrl();
        if (detailUrl.includes('/tim/detail-tim')) {
            console.log(chalk.green("Tim detail page test passed!"));
        } else {
            console.log(chalk.red("Tim detail page test failed!"));
        }

        // Scroll ke footer dan kembali ke atas
        await smoothScrollToFooterAndBack(driver);

        // Kembali ke halaman beranda
        await driver.navigate().back();
        await driver.sleep(2000);

        // Temukan artikel pertama dan klik
        let articleLink = await driver.wait(until.elementLocated(By.css('.detail-artikel')), 10000);
        await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'center' });", articleLink);

        // Klik artikel menggunakan JavaScript sebagai alternatif
        await driver.executeScript("arguments[0].click();", articleLink);

        // Tunggu halaman detail artikel dimuat
        await driver.sleep(2000);

        // Verifikasi URL halaman detail artikel
        let detailArticleUrl = await driver.getCurrentUrl();
        if (detailArticleUrl.includes('/artikel/detail-artikel')) {
            console.log(chalk.green("Artikel detail page test passed!"));
        } else {
            console.log(chalk.red("Artikel detail page test failed!"));
        }

        // Scroll ke footer dan kembali ke atas
        await smoothScrollToFooterAndBack(driver);

        // Kembali ke halaman beranda
        await driver.navigate().back();
        await driver.sleep(2000);

        // Temukan tombol "Lihat Semua" dan klik
        let seeAllLink = await driver.wait(until.elementLocated(By.css('.all-artikel')), 10000);
        await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'center' });", seeAllLink);

        // Klik "Lihat Semua"
        await seeAllLink.click();

        // Tunggu halaman artikel dimuat
        await driver.sleep(2000);

        // Verifikasi URL halaman artikel
        let artikelUrl = await driver.getCurrentUrl();
        if (artikelUrl.includes('/artikel')) {
            console.log(chalk.green("See All artikel page test passed!"));
        } else {
            console.log(chalk.red("See All artikel page test failed!"));
        }

        // Scroll ke footer dan kembali ke atas
        await smoothScrollToFooterAndBack(driver);

        // Kembali ke halaman beranda
        await driver.navigate().back();
        await driver.sleep(2000);

        // Temukan detail kegiatan pertama dan klik
        let detailKegiatanLink = await driver.wait(until.elementLocated(By.css('.detail-kegiatan')), 10000);
        await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'center' });", detailKegiatanLink);

        // Klik detail kegiatan menggunakan JavaScript sebagai alternatif
        await driver.executeScript("arguments[0].click();", detailKegiatanLink);

        // Tunggu halaman detail kegiatan dimuat
        await driver.sleep(2000);

        // Verifikasi URL halaman detail kegiatan
        let detailKegiatanUrl = await driver.getCurrentUrl();
        if (detailKegiatanUrl.includes('/kegiatan/detail-kegiatan')) {
            console.log(chalk.green("Kegiatan detail page test passed!"));
        } else {
            console.log(chalk.red("Kegiatan detail page test failed!"));
        }

        // Scroll ke footer dan kembali ke atas
        await smoothScrollToFooterAndBack(driver);

        // Kembali ke halaman beranda
        await driver.navigate().back();
        await driver.sleep(2000);

        // Temukan tombol "Lihat Semua" kegiatan dan klik
        let seeAllKegiatanLink = await driver.wait(until.elementLocated(By.css('.all-kegiatan')), 10000);
        await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'center' });", seeAllKegiatanLink);

        // Klik "Lihat Semua" kegiatan
        await seeAllKegiatanLink.click();

        // Tunggu halaman kegiatan dimuat
        await driver.sleep(2000);

        // Verifikasi URL halaman kegiatan
        let kegiatanUrl = await driver.getCurrentUrl();
        if (kegiatanUrl.includes('/kegiatan')) {
            console.log(chalk.green("See All kegiatan page test passed!"));
        } else {
            console.log(chalk.red("See All kegiatan page test failed!"));
        }

        // Scroll ke footer dan kembali ke atas
        await smoothScrollToFooterAndBack(driver);

        // Kembali ke halaman beranda
        await driver.navigate().back();
        await driver.sleep(2000);


        // Temukan marker hijau pada peta dan klik untuk membuka popup
        let mapMarker = await driver.wait(until.elementLocated(By.css('.leaflet-marker-icon.marker-green')), 10000);
        await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'center' });", mapMarker);
        await driver.executeScript("arguments[0].click();", mapMarker);

        // Tunggu popup muncul
        await driver.sleep(2000);

        // Temukan detail potensi desa dalam popup
        let detailPotensiDesaLink = await driver.wait(until.elementLocated(By.css('.detail-potensi-desa a')), 15000);
        await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'center' });", detailPotensiDesaLink);

        // Klik detail potensi desa menggunakan JavaScript sebagai alternatif
        await driver.executeScript("arguments[0].click();", detailPotensiDesaLink);


        // Tunggu halaman detail potensi desa dimuat
        await driver.sleep(2000);

        // Verifikasi URL halaman detail potensi desa
        let detailPotensiDesaUrl = await driver.getCurrentUrl();
        if (detailPotensiDesaUrl.includes('/persebaran/detail-desa')) {
            console.log(chalk.green("Detail potensi desa page test passed!"));
        } else {
            console.log(chalk.red("Detail potensi desa page test failed!"));
        }

        // Scroll ke footer dan kembali ke atas
        await smoothScrollToFooterAndBack(driver);

        // Kembali ke halaman beranda
        await driver.navigate().back();
        await driver.sleep(2000);

        // Hilangkan popup marker hijau
        let mapArea = await driver.wait(until.elementLocated(By.id('map')), 10000);
        await driver.executeScript("arguments[0].click();", mapArea);

        // Tambahkan waktu jeda untuk memastikan peta telah termuat sepenuhnya
        await driver.sleep(5000);

        // Cari marker biru pada peta dan klik untuk membuka popup UMKM
        let mapMarkerUMKM = await driver.wait(until.elementLocated(By.css('.leaflet-marker-icon.marker-blue')), 20000); // Tambah timeout menjadi 20 detik
        await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'center' });", mapMarkerUMKM);
        await driver.executeScript("arguments[0].click();", mapMarkerUMKM);

        // Tunggu popup UMKM muncul
        await driver.sleep(2000);

        // Temukan detail UMKM dalam popup
        let detailUMKMLink = await driver.wait(until.elementLocated(By.css('.detail-persebaran-umkm a')), 10000);
        await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'center' });", detailUMKMLink);

        // Klik detail UMKM menggunakan JavaScript sebagai alternatif
        await driver.executeScript("arguments[0].click();", detailUMKMLink);

        // Tunggu halaman detail UMKM dimuat
        await driver.sleep(2000);

        // Verifikasi URL halaman detail UMKM
        let detailUMKMUrl = await driver.getCurrentUrl();
        if (detailUMKMUrl.includes('/persebaran/detail-umkm')) {
            console.log(chalk.green("Detail UMKM page test passed!"));
        } else {
            console.log(chalk.red("Detail UMKM page test failed!"));
        }

        // Scroll ke footer dan kembali ke atas
        await smoothScrollToFooterAndBack(driver);

        // Kembali ke halaman beranda
        await driver.navigate().back();
        await driver.sleep(2000);

        // Scroll ke footer dan kembali ke atas
        await smoothScrollToFooterAndBack(driver);

    } catch (error) {
        console.error(chalk.red("Test failed with error: "), error);
    }
}






// Fungsi untuk mengetes tautan "Profil" dan submenu-nya
async function testProfilMenu(driver) {
    console.log("===================================");
    console.log(chalk.grey("Testing 'Profil' menu and submenus..."));

    // Temukan dan klik menu 'Profil'
    let profilLink = await driver.wait(until.elementLocated(By.id('profil')), 10000);
    await driver.wait(until.elementIsVisible(profilLink), 10000);
    await profilLink.click();

    // Tunggu beberapa waktu agar submenu muncul
    await driver.sleep(2000);

    // Daftar submenu dan URL yang diharapkan
    const submenuItems = [
        { id: 'sejarah', expectedUrl: 'http://127.0.0.1:8000/profil/sejarah' },
        { id: 'visi-misi', expectedUrl: 'http://127.0.0.1:8000/profil/visimisi' },
        { id: 'struktur-organisasi', expectedUrl: 'http://127.0.0.1:8000/profil/struktur-organisasi' },
        { id: 'tim', expectedUrl: 'http://127.0.0.1:8000/tim' }
    ];

    for (let item of submenuItems) {
        try {
            // Temukan tautan submenu menggunakan id
            let submenuLink = await driver.wait(until.elementLocated(By.id(item.id)), 15000);

            // Scroll ke elemen sebelum mengkliknya agar terlihat dengan efek scroll halus
            await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'center' });", submenuLink);

            // Tunggu hingga elemen terlihat
            await driver.wait(until.elementIsVisible(submenuLink), 1500);

            // Klik submenu
            await submenuLink.click();

            // Tunggu halaman dimuat
            await driver.sleep(2000);

            // Verifikasi URL setelah klik
            let url = await driver.getCurrentUrl();
            if (url === item.expectedUrl) {
                console.log(chalk.green(`${item.id} submenu test passed!`));
            } else {
                console.log(chalk.red(`${item.id} submenu test failed!`));
            }

            // Jika submenu 'tim', arahkan ke detail tim
            if (item.id === 'tim') {
                console.log(chalk.grey(`Navigating to detail tim page...`));

                // Temukan tautan ke detail tim yang mengandung "/tim/detail-tim"
                let detailTimLink = await driver.wait(until.elementLocated(By.xpath('//a[contains(@href, "/tim/detail-tim")]')), 10000);
                await driver.wait(until.elementIsVisible(detailTimLink), 10000);

                // Dapatkan URL detail tim dari href
                let detailUrl = await detailTimLink.getAttribute("href");
                await detailTimLink.click();

                // Verifikasi URL setelah mengklik detail tim
                let currentUrl = await driver.getCurrentUrl();
                if (currentUrl === detailUrl) {
                    console.log(chalk.green(`Detail tim test passed!`));
                } else {
                    console.log(chalk.red(`Detail tim test failed!`));
                }

                // Scroll ke footer dan kembali ke atas
                await smoothScrollToFooterAndBack(driver);

            } else {
                // Scroll ke footer dan kembali ke atas
                await smoothScrollToFooterAndBack(driver);
            }

            // Scroll kembali ke profil untuk mengklik submenu berikutnya dengan efek scroll halus
            profilLink = await driver.findElement(By.id('profil'));
            await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'center' });", profilLink);
            await driver.sleep(2000);

            // Klik 'Profil' untuk memunculkan submenu kembali
            await profilLink.click();
            await driver.sleep(2000);

        } catch (error) {
            console.error(chalk.red(`${item.id} submenu test failed with error: `), error);
        }

    }

}






// Fungsi untuk mengetes tautan "Sumber Daya" dan submenu-nya
async function testSumberDayaMenu(driver) {
    console.log("===================================");
    console.log(chalk.grey("Testing 'Sumber Daya' menu and submenus..."));

    // Temukan dan klik menu 'Sumber Daya'
    let sumberDayaLink = await driver.wait(until.elementLocated(By.id('sumber-daya')), 10000);
    await driver.wait(until.elementIsVisible(sumberDayaLink), 10000);
    await sumberDayaLink.click();

    // Tunggu beberapa waktu agar submenu muncul
    await driver.sleep(2000);

    // Daftar submenu dan URL yang diharapkan
    const submenuItems = [
        { id: 'artikel', expectedUrl: 'http://127.0.0.1:8000/artikel' },
        { id: 'kegiatan', expectedUrl: 'http://127.0.0.1:8000/kegiatan' },
        { id: 'persebaran-umkm', expectedUrl: 'http://127.0.0.1:8000/persebaran' }
    ];

    for (let item of submenuItems) {
        try {
            // Temukan tautan submenu menggunakan id
            let submenuLink = await driver.wait(until.elementLocated(By.id(item.id)), 15000);

            // Scroll ke elemen sebelum mengkliknya agar terlihat
            await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'center' });", submenuLink);

            // Tunggu hingga elemen terlihat
            await driver.wait(until.elementIsVisible(submenuLink), 1500);

            // Klik langsung submenu
            await submenuLink.click();

            // Tunggu halaman dimuat
            await driver.sleep(2000);

            // Verifikasi URL setelah klik
            let url = await driver.getCurrentUrl();
            if (url === item.expectedUrl) {
                console.log(chalk.green(`${item.id} submenu test passed!`));
            } else {
                console.log(chalk.red(`${item.id} submenu test failed!`));
            }

            // Scroll ke footer dan kembali ke atas
            await smoothScrollToFooterAndBack(driver);


            // Scroll kembali ke sumber-daya untuk mengklik submenu berikutnya
            sumberDayaLink = await driver.findElement(By.id('sumber-daya'));
            await driver.executeScript("arguments[0].scrollIntoView({ behavior: 'smooth', block: 'center' });", sumberDayaLink);
            await driver.sleep(2000);

            // Klik 'Sumber Daya' untuk memunculkan submenu kembali
            await sumberDayaLink.click();
            await driver.sleep(2000);

        } catch (error) {
            console.error(chalk.red(`${item.id} submenu test failed with error: `), error);
        }
    }

    // await testKontakMenu(driver)

}




// Fungsi untuk mengetes menu "Kontak"
async function testKontakMenu(driver) {
    console.log("===================================");
    console.log(chalk.grey("Testing 'Kontak' menu..."));

    try {
        // Temukan dan klik menu 'Kontak'
        let kontakLink = await driver.wait(until.elementLocated(By.id('kontak')), 15000);
        await driver.wait(until.elementIsVisible(kontakLink), 15000);
        await kontakLink.click();

        // Tunggu beberapa waktu agar halaman menggulir ke bagian footer dengan ID 'contact'
        await driver.sleep(2000);

        // Verifikasi apakah elemen dengan ID 'contact' terlihat setelah scroll
        let contactElement = await driver.wait(until.elementLocated(By.id('contact')), 10000);
        await driver.wait(until.elementIsVisible(contactElement), 10000);

        let isContactVisible = await contactElement.isDisplayed();
        if (isContactVisible) {
            console.log(chalk.green("Kontak menu test passed! Contact section is visible."));
        } else {
            console.log(chalk.red("Kontak menu test failed! Contact section is not visible."));
        }

        // Kembali ke atas halaman untuk melanjutkan pengujian jika diperlukan
        await driver.executeScript("window.scrollTo(0, 0);");
        await driver.sleep(2000);


    } catch (error) {
        console.error(chalk.red("Kontak menu test failed with error: "), error);
    }
}








// Fungsi untuk mengetes menu "Museum"
async function testMuseumMenu(driver) {
    try {

        // Temukan dan klik menu 'Museum'
        let museumLink = await driver.wait(until.elementLocated(By.id('museum')), 15000);
        await driver.wait(until.elementIsVisible(museumLink), 15000);
        await museumLink.click();

        // Tunggu beberapa waktu agar halaman dimuat
        await driver.sleep(3000);

        // Verifikasi URL setelah klik
        let currentUrl = await driver.getCurrentUrl();
        if (currentUrl.includes('/museum')) {
            console.log(chalk.green("Museum menu test passed!"));
        } else {
            console.log(chalk.red("Museum menu test failed!"));
        }

    } catch (error) {
        console.error(chalk.red("Museum menu test failed with error: "), error);
    }
}






// Fungsi utama yang menjalankan semua tes
async function test_beranda() {
    let driver = await new Builder().forBrowser('chrome').build();

    try {
        await driver.manage().window().maximize();
        await driver.get('http://127.0.0.1:8000');
        // await testBeranda(driver);
        // await testProfilMenu(driver);
        await testSumberDayaMenu(driver);
        await testMuseumMenu(driver)
        await testKontakMenu(driver);


        // Kembali ke halaman beranda
        await driver.navigate().to('http://127.0.0.1:8000');
        await driver.sleep(2000);

    } catch (error) {
        console.error(chalk.red("Test failed: "), error);
    } finally {
        await driver.quit();
    }
}

// Jalankan semua tes
test_beranda();
import { Builder, By, until } from 'selenium-webdriver';
import chalk from 'chalk';
import assert from 'assert';
import fs from 'fs';
import path from 'path'; // Untuk memuat file foto

async function testLogin(driver) {
    try {
        // Akses halaman login
        await driver.get('http://127.0.0.1:8000/login');

        // Uji kredensial yang salah
        await driver.findElement(By.id('email')).sendKeys('wronguser@gmail.com');
        await driver.sleep(1000); // Jeda 1 detik
        await driver.findElement(By.id('password')).sendKeys('wrongpassword');
        await driver.sleep(1000); // Jeda 1 detik

        // Temukan dan klik tombol submit
        let submitButton = await driver.findElement(By.css('form button[type="submit"], form input[type="submit"]'));
        await submitButton.click();
        await driver.sleep(2000); // Jeda 2 detik untuk menunggu proses login

        // Tunggu pesan kesalahan muncul
        let errorMessages = await driver.wait(until.elementsLocated(By.css('.text-red-500.text-xs.italic.mt-2')), 10000);

        // Verifikasi pesan kesalahan
        let errorTexts = [];
        for (let message of errorMessages) {
            errorTexts.push(await message.getText());
        }

        // Perbarui dengan pesan kesalahan yang sesuai
        assert(errorTexts.length > 0, 'No error messages found');
        assert(errorTexts.some(text => text.includes('Email / password tidak sesuai.') || text.includes('Password salah.')),
            `Expected error message to include 'Email / password tidak sesuai.' or 'Password salah.', but got ${errorTexts.join(', ')}`);

        console.log(chalk.green("Login test dengan email/password salah sukses dan menampilkan pesan kesalahan."));

        // Reset form dengan menghapus input sebelum tes kredensial yang benar
        await driver.findElement(By.id('email')).clear();
        await driver.findElement(By.id('password')).clear();

        // Uji kredensial yang benar
        await driver.findElement(By.id('email')).sendKeys('admin1@gmail.com');
        await driver.sleep(1000); // Jeda 1 detik
        await driver.findElement(By.id('password')).sendKeys('qwe123');
        await driver.sleep(1000); // Jeda 1 detik

        // Temukan dan klik tombol submit
        submitButton = await driver.findElement(By.css('form button[type="submit"], form input[type="submit"]'));
        await submitButton.click();
        await driver.sleep(2000); // Jeda 2 detik untuk menunggu proses login

        // Tunggu hingga beranda dimuat
        await driver.wait(until.urlContains('/dashboard'), 10000);

        // Verifikasi URL saat ini
        let currentUrl = await driver.getCurrentUrl();
        assert(currentUrl.includes('/dashboard'), `URL after login should include '/dashboard', but got ${currentUrl}`);

        // Tunggu hingga SweetAlert muncul
        await driver.wait(until.elementLocated(By.css('.swal2-confirm')), 10000); // Menunggu tombol OK SweetAlert muncul

        // Klik tombol OK pada SweetAlert
        let swalOkButton = await driver.findElement(By.css('.swal2-confirm'));
        await swalOkButton.click();
        await driver.sleep(1000); // Jeda 1 detik untuk menunggu proses klik

        console.log(chalk.green("Login test berhasil'"));

    } catch (error) {
        console.error(chalk.red("Login Test gagal dengan error: "), error);
    }
}

async function testYourProfile(driver) {
    try {
        // Klik menu profil untuk membuka submenu your profile
        let profileMenuButton = await driver.findElement(By.id('profile-menu-button'));
        await profileMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Klik tombol Your Profile
        let yourProfileButton = await driver.findElement(By.xpath("//a[contains(text(), 'Your Profile')]"));
        await yourProfileButton.click();
        await driver.sleep(2000);

        // Verifikasi apakah navigasi ke halaman edit profil berhasil
        await driver.wait(until.urlIs('http://127.0.0.1:8000/dashboard/profil-admin'), 5000);

        // Klik tombol edit profile
        let editProfileButton = await driver.findElement(By.xpath("//a[contains(text(), 'Edit Profil Admin')]"));
        await editProfileButton.click();
        await driver.sleep(2000);

        // Verifikasi apakah navigasi ke halaman edit profil berhasil
        await driver.wait(until.urlIs('http://127.0.0.1:8000/dashboard/edit-profil-admin'), 5000);

        // Kembali ke halaman beranda
        await driver.navigate().back();
        await driver.sleep(2000);

        // Klik tombol edit profile
        let editPasswordButton = await driver.findElement(By.xpath("//a[contains(text(), 'Edit Password Admin')]"));
        await editPasswordButton.click();
        await driver.sleep(2000);

        // Verifikasi apakah navigasi ke halaman edit profil berhasil
        await driver.wait(until.urlIs('http://127.0.0.1:8000/dashboard/edit-password-admin'), 5000);
        console.log(chalk.green('Test Your Profile passed successfully'));
    } catch (error) {
        console.error(chalk.red("Test Your Profile failed with error: "), error);
    }
}


async function testEditProfile(driver) {
    try {
        // Klik menu profil untuk membuka submenu edit profile
        let profileMenuButton = await driver.findElement(By.id('profile-menu-button'));
        await profileMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Klik tombol edit profile
        let editProfileButton = await driver.findElement(By.xpath("//a[contains(text(), 'Edit Profile')]"));
        await editProfileButton.click();
        await driver.sleep(2000);

        // Verifikasi apakah navigasi ke halaman edit profil berhasil
        await driver.wait(until.urlIs('http://127.0.0.1:8000/dashboard/edit-profil-admin'), 5000);

        // Ubah nilai Nama
        let nameInput = await driver.findElement(By.id('name'));
        await nameInput.clear();
        await nameInput.sendKeys('AdminPUIGEMAR');
        await driver.sleep(2000); // Jeda 2 detik

        // Upload Foto Profil baru
        let fotoInput = await driver.findElement(By.id('foto'));
        let fotoPath = path.resolve('D:\arifff.jpg');
        await fotoInput.sendKeys(fotoPath);
        await driver.sleep(2000); // Jeda 2 detik

        // Klik tombol Simpan
        let simpanButton = await driver.findElement(By.xpath("//button[contains(text(), 'Simpan')]"))
        await simpanButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga navigasi selesai dan halaman selesai dimuat
        await driver.wait(until.urlIs('http://127.0.0.1:8000/dashboard'), 5000);

        // Tunggu SweetAlert muncul
        await driver.wait(until.elementLocated(By.className('swal2-confirm')), 5000);

        // Klik tombol OK di SweetAlert
        let swalButton = await driver.findElement(By.className('swal2-confirm'));
        await swalButton.click();

        // Tunggu hingga swal ditutup
        await driver.sleep(2000);

        // Verifikasi apakah perubahan nama berhasil disimpan
        let welcomeMessage = await driver.findElement(By.xpath("//h1[contains(text(), 'Selamat datang')]")).getText();
        assert.ok(welcomeMessage.includes('AdminPUIGEMAR'), 'Nama pengguna tidak diperbarui dengan benar');

        console.log(chalk.green('Test Edit Profile passed successfully'));
    } catch (error) {
        console.error(chalk.red("Test Edit Profilet failed with error: "), error);
    }
}


async function testEditPassword(driver) {
    try {
        // Klik menu profil untuk membuka submenu edit password
        let profileMenuButton = await driver.findElement(By.id('profile-menu-button'));
        await profileMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Klik tombol edit password
        let editProfileButton = await driver.findElement(By.xpath("//a[contains(text(), 'Edit Password')]"));
        await editProfileButton.click();
        await driver.sleep(2000);

        // Verifikasi apakah navigasi ke halaman edit profil berhasil
        await driver.wait(until.urlIs('http://127.0.0.1:8000/dashboard/edit-password-admin'), 5000);

        // Masukkan password lama
        let passwordLamaInput = await driver.findElement(By.id('password_lama'));
        await passwordLamaInput.clear();
        await passwordLamaInput.sendKeys('qwe123');
        await driver.sleep(2000); // Jeda 2 detik

        // Masukkan nilai password baru
        let passwordInput = await driver.findElement(By.id('password'));
        await passwordInput.clear();
        await passwordInput.sendKeys('qwe123');
        await driver.sleep(2000); // Jeda 2 detik

        // Konfirmasi ulang nilai password baru
        let passwordConfirmationInput = await driver.findElement(By.id('password_confirmation'));
        await passwordConfirmationInput.clear();
        await passwordConfirmationInput.sendKeys('qwe123');
        await driver.sleep(2000); // Jeda 2 detik

        // Klik tombol Simpan
        let simpanButton = await driver.findElement(By.xpath("//button[contains(text(), 'Simpan')]"))
        await simpanButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga navigasi selesai dan halaman selesai dimuat
        await driver.wait(until.urlIs('http://127.0.0.1:8000/dashboard'), 5000);

        // Tunggu SweetAlert muncul
        await driver.wait(until.elementLocated(By.className('swal2-confirm')), 5000);

        // Klik tombol OK di SweetAlert
        let swalButton = await driver.findElement(By.className('swal2-confirm'));
        await swalButton.click();

        // Tunggu hingga swal ditutup
        await driver.sleep(2000);

        console.log(chalk.green('Test Edit Password passed successfully'));

    } catch (error) {
        console.error(chalk.red("Test Edit Password failed with error: "), error);
    }
}


async function testLogout(driver) {
    try {
        // Klik menu profil untuk membuka submenu logout
        let profileMenuButton = await driver.findElement(By.id('profile-menu-button'));
        await profileMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Klik tombol logout
        let logoutButton = await driver.findElement(By.id('logoutButton'));
        await logoutButton.click();
        await driver.sleep(2000);

        // Tunggu hingga SweetAlert konfirmasi muncul
        await driver.wait(until.elementLocated(By.css('.swal2-confirm')), 10000); // Menunggu tombol konfirmasi SweetAlert muncul

        // Klik tombol konfirmasi pada SweetAlert
        let confirmButton = await driver.findElement(By.css('.swal2-confirm'));
        await confirmButton.click();
        await driver.sleep(2000); // Jeda 2 detik untuk menunggu proses logout

        // Tunggu hingga halaman login dimuat
        await driver.wait(until.urlContains('/login'), 20000); // Ganti '/login' jika perlu

        // Verifikasi URL setelah logout
        let currentUrl = await driver.getCurrentUrl();
        assert(currentUrl.includes('/login'), `URL after logout should include '/login', but got ${currentUrl}`);

        console.log(chalk.green("Logout test passed and URL correctly contains '/login'"));

    } catch (error) {
        console.error(chalk.red("Logout Test failed with error: "), error);
    }
}

async function testBackToBeranda(driver) {
    try {
        // Tunggu hingga tautan muncul
        let linkElement = await driver.wait(until.elementLocated(By.xpath("//a[contains(text(), 'Klik di sini')]")), 10000);
        await linkElement.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga URL berubah
        await driver.wait(until.urlContains('http://127.0.0.1:8000/'), 10000); // Ganti '/dashboard-website' dengan rute yang sesuai

        // Verifikasi URL saat ini
        let currentUrl = await driver.getCurrentUrl();
        assert(currentUrl === 'http://127.0.0.1:8000/', `URL after clicking the link should be 'http://127.0.0.1:8000/', but got ${currentUrl}`);

        console.log(chalk.green("Back to Beranda test passed"));

    } catch (error) {
        console.error(chalk.red("Back to Beranda Test failed with error: "), error);
    }
}

async function toDashboard(driver) {
    // Tunggu hingga menu profil terlihat
    let DashboardButton = await driver.wait(until.elementIsVisible(driver.findElement(By.xpath("//a[contains(text(), 'Dashboard')]"))), 5000);
    await DashboardButton.click();
    await driver.sleep(2000); // Jeda 2 detik
}

async function toSejarah(driver) {
    // Tunggu hingga submenu sejarah terlihat
    let sejarahButton = await driver.wait(until.elementIsVisible(driver.findElement(By.xpath("//a[contains(text(), 'Sejarah')]"))), 5000);
    await sejarahButton.click();
    await driver.sleep(2000); // Jeda 2 detik

    // Tunggu hingga navigasi selesai dan halaman selesai dimuat
    await driver.wait(until.urlIs('http://127.0.0.1:8000/admin/sejarah'), 5000);
    await driver.sleep(1000);
    console.log(chalk.green("Sejarah Sub Menu Admin test passed"));

    // Kembali ke halaman beranda
    await driver.navigate().back();
    await driver.sleep(2000);
}

async function toVisiMisi(driver) {
    try {
        // Tunggu hingga submenu visiMisi terlihat
        let visiMisiButton = await driver.wait(until.elementIsVisible(driver.findElement(By.xpath("//a[contains(text(), 'Visi Misi')]"))), 5000);
        await visiMisiButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga navigasi selesai dan halaman selesai dimuat
        await driver.wait(until.urlIs('http://127.0.0.1:8000/admin/visimisi'), 5000);
        await driver.sleep(1000);

        // Cek apakah elemen yang menunjukkan tidak ada data muncul
        let noDataMessagePresent = true;
        let dataPresent = true;

        try {
            // Tunggu hingga elemen yang menandakan tidak ada data muncul
            let noDataElement = await driver.findElement(By.xpath("//div[contains(@class, 'flex') and contains(text(), 'Mohon Maaf Admin')]"));
            noDataMessagePresent = await noDataElement.isDisplayed();
        } catch (error) {
            // Jika elemen tidak ditemukan, berarti data mungkin ada
        }

        if (noDataMessagePresent) {
            console.log(chalk.yellow("Data Visi Misi tidak tersedia, mengklik tombol tambah..."));

            // Klik tombol tambah Visi Misi
            let addButton = await driver.findElement(By.xpath("//button[contains(@aria-label, 'Tambah Visi Misi')]"));
            await addButton.click();
            await driver.sleep(2000); // Jeda 2 detik setelah klik tombol tambah

            // Tunggu hingga navigasi ke halaman tambah visi misi selesai
            await driver.wait(until.urlIs('http://127.0.0.1:8000/admin/visimisi/create'), 5000);
            await driver.sleep(1000);

            console.log(chalk.green("Navigasi ke halaman tambah Visi Misi berhasil"));


            // Gunakan JavaScript untuk mengisi Summernote
            await driver.executeScript("$('#summernote').summernote('code', 'Visi PUI GEMAR yang baru');");
            await driver.sleep(2000);

            // Tambahkan Misi
            let missionInputs = await driver.findElements(By.xpath("//div[@id='missions']//input[@name='missions[]']"));
            for (let i = 0; i < missionInputs.length; i++) {
                await missionInputs[i].clear();
                await missionInputs[i].sendKeys('Misi PUI GEMAR yang baru');
                await driver.sleep(2000);
            }

            // Klik tombol Simpan
            let saveButton = await driver.findElement(By.xpath("//button[contains(text(), 'Simpan')]"));
            await saveButton.click();
            await driver.sleep(2000); // Jeda 2 detik

            // Tunggu hingga navigasi selesai dan halaman selesai dimuat
            await driver.wait(until.urlIs('http://127.0.0.1:8000/admin/visimisi'), 5000);
            // Tunggu SweetAlert muncul
            await driver.wait(until.elementLocated(By.className('swal2-confirm')), 5000);

            // Klik tombol OK di SweetAlert
            let swalButton = await driver.findElement(By.className('swal2-confirm'));
            await swalButton.click();

            // Tunggu hingga swal ditutup
            await driver.sleep(2000);
            console.log(chalk.green("Data Visi Misi berhasil disimpan dan halaman kembali ditampilkan"));


        } else {
            // Cek apakah elemen yang menunjukkan adanya data ada
            try {
                let visiHeader = await driver.findElement(By.xpath("//h1[contains(text(), 'Visi')]"));
                let misiHeader = await driver.findElement(By.xpath("//h1[contains(text(), 'Misi')]"));
                dataPresent = (await visiHeader.isDisplayed()) && (await misiHeader.isDisplayed());
            } catch (error) {
                // Jika elemen tidak ditemukan, berarti data mungkin tidak ada
            }

            if (dataPresent) {
                console.log(chalk.green("Data Visi Misi tersedia, lanjut ke halaman edit..."));

                // Klik untuk mengedit data Visi Misi
                // let editButton = await driver.findElement(By.xpath("//a[contains(text(), 'Edit Visi Misi')]"))
                let editButton = await driver.findElement(By.xpath("//button[contains(@aria-label, 'Edit Visi Misi')]"));;
                await editButton.click();
                await driver.sleep(2000); // Jeda 2 detik setelah klik tombol edit

                // Tunggu hingga navigasi ke halaman edit visi misi selesai
                await driver.wait(until.urlIs('http://127.0.0.1:8000/admin/edit-visimisi'), 5000);
                await driver.sleep(1000);

                console.log(chalk.green("Navigasi ke halaman edit Visi Misi berhasil"));
            } else {
                console.log(chalk.red("Data Visi Misi tidak ditemukan dengan benar"));
            }
        }

        // Klik Toggle Button untuk memunculkan menu admin
        let toogleMenuButton = await driver.findElement(By.id('menu-button'));
        await toogleMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

    } catch (error) {
        console.error(chalk.red("Test failed: ", error));
    }
}

async function toStrukturOrganisasi(driver) {
    try {
        // Tunggu hingga submenu struktur organisasi terlihat
        let visiMisiButton = await driver.wait(until.elementIsVisible(driver.findElement(By.xpath("//a[contains(text(), 'Struktur Organisasi')]"))), 5000);
        await visiMisiButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga navigasi selesai dan halaman selesai dimuat
        await driver.wait(until.urlIs('http://127.0.0.1:8000/admin/struktur-organisasi'), 5000);
        await driver.sleep(3000);

        console.log(chalk.green("Struktur Organisasi Menu test passed"));

        // Klik Toggle Button untuk memunculkan menu admin
        let toogleMenuButton = await driver.findElement(By.id('menu-button'));
        await toogleMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga menu profil terlihat
        let profilButton = await driver.wait(until.elementIsVisible(driver.findElement(By.id('profilSubMenuToggle'))), 5000);
        await profilButton.click();
        await driver.sleep(2000); // Jeda 2 detik

    } catch (error) {
        console.error(chalk.red("Test failed: ", error));
    }
}

async function toTeam(driver) {
    try {
        // Tunggu hingga submenu struktur organisasi terlihat
        let visiMisiButton = await driver.wait(until.elementIsVisible(driver.findElement(By.xpath("//a[contains(text(), 'Tim')]"))), 5000);
        await visiMisiButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga navigasi selesai dan halaman selesai dimuat
        await driver.wait(until.urlIs('http://127.0.0.1:8000/admin/tim'), 5000);
        await driver.sleep(3000);

        console.log(chalk.green("Tim Admin Menu test passed"));

        // Klik Toggle Button untuk memunculkan menu admin
        let toogleMenuButton = await driver.findElement(By.id('menu-button'));
        await toogleMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga menu profil terlihat
        let profilButton = await driver.wait(until.elementIsVisible(driver.findElement(By.id('profilSubMenuToggle'))), 5000);
        await profilButton.click();
        await driver.sleep(2000); // Jeda 2 detik

    } catch (error) {
        console.error(chalk.red("Test failed: ", error));
    }
}

async function testProfil(driver) {
    try {
        // Klik Toggle Button untuk memunculkan menu admin
        let toogleMenuButton = await driver.findElement(By.id('menu-button'));
        await toogleMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga menu profil terlihat
        let profilButton = await driver.wait(until.elementIsVisible(driver.findElement(By.id('profilSubMenuToggle'))), 5000);
        await profilButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        console.log(chalk.green("Profil Menu test passed"));

        // await toSejarah(driver);
        // await toVisiMisi(driver);
        await toStrukturOrganisasi(driver);
        await toTeam(driver);
        await toDashboard(driver);

    } catch (error) {
        console.error(chalk.red("Test Profil Menu failed: ", error));
    }
}


async function toArtikel(driver) {
    try {
        // Tunggu hingga submenu artikel terlihat
        let artikelButton = await driver.wait(until.elementIsVisible(driver.findElement(By.xpath("//a[contains(text(), 'Artikel')]"))), 5000);
        await artikelButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga navigasi selesai dan halaman selesai dimuat
        await driver.wait(until.urlIs('http://127.0.0.1:8000/admin/artikel'), 5000);
        await driver.sleep(3000);

        // Scroll halus ke bawah menggunakan JavaScript
        await driver.executeScript("window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });");
        await driver.sleep(3000);

        // Scroll kembali ke atas
        await driver.executeScript("window.scrollTo({ top: 0, behavior: 'smooth' });");
        await driver.sleep(3000);

        console.log(chalk.green("Artikel Admin Menu test passed"));

        // Klik Toggle Button untuk memunculkan menu admin
        let toogleMenuButton = await driver.findElement(By.id('menu-button'));
        await toogleMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga menu sumber daya terlihat
        let profilButton = await driver.wait(until.elementIsVisible(driver.findElement(By.id('sumberdayaSubMenuToggle'))), 5000);
        await profilButton.click();
        await driver.sleep(2000); // Jeda 2 detik

    } catch (error) {
        console.error(chalk.red("Test failed: ", error));
    }
}

async function toKegiatan(driver) {
    try {
        // Tunggu hingga submenu kegiatan terlihat
        let kegiatanButton = await driver.wait(until.elementIsVisible(driver.findElement(By.xpath("//a[contains(text(), 'Kegiatan')]"))), 5000);
        await kegiatanButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga navigasi selesai dan halaman selesai dimuat
        await driver.wait(until.urlIs('http://127.0.0.1:8000/admin/kegiatan'), 5000);
        await driver.sleep(3000);

        // Scroll halus ke bawah menggunakan JavaScript
        await driver.executeScript("window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });");
        await driver.sleep(3000);

        // Scroll kembali ke atas
        await driver.executeScript("window.scrollTo({ top: 0, behavior: 'smooth' });");
        await driver.sleep(3000);

        console.log(chalk.green("Kegiatan Admin Menu test passed"));

        // Klik Toggle Button untuk memunculkan menu admin
        let toogleMenuButton = await driver.findElement(By.id('menu-button'));
        await toogleMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga menu sumber daya terlihat
        let profilButton = await driver.wait(until.elementIsVisible(driver.findElement(By.id('sumberdayaSubMenuToggle'))), 5000);
        await profilButton.click();
        await driver.sleep(2000); // Jeda 2 detik

    } catch (error) {
        console.error(chalk.red("Test failed: ", error));
    }
}

async function toPersebaranUMKM(driver) {
    try {
        // Tunggu hingga submenu persebaran UMKM terlihat
        let kegiatanButton = await driver.wait(until.elementIsVisible(driver.findElement(By.xpath("//a[contains(text(), 'Persebaran UMKM')]"))), 5000);
        await kegiatanButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga navigasi selesai dan halaman selesai dimuat
        await driver.wait(until.urlIs('http://127.0.0.1:8000/admin/persebaran'), 5000);
        await driver.sleep(3000);

        // Scroll halus ke bawah menggunakan JavaScript
        await driver.executeScript("window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });");
        await driver.sleep(3000);

        // Scroll kembali ke atas
        await driver.executeScript("window.scrollTo({ top: 0, behavior: 'smooth' });");
        await driver.sleep(3000);

        console.log(chalk.green("Persebaran UMKM Admin Menu test passed"));

        // Klik Toggle Button untuk memunculkan menu admin
        let toogleMenuButton = await driver.findElement(By.id('menu-button'));
        await toogleMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik



    } catch (error) {
        console.error(chalk.red("Test failed: ", error));
    }
}


async function testSumberDaya(driver) {
    try {
        // Klik Toggle Button untuk memunculkan menu admin
        let toogleMenuButton = await driver.findElement(By.id('menu-button'));
        await toogleMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga menu sumberDaya terlihat
        let sumberDayaButton = await driver.wait(until.elementIsVisible(driver.findElement(By.id('sumberdayaSubMenuToggle'))), 5000);
        await sumberDayaButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        console.log(chalk.green("SumberDaya Menu test passed"));

        await toArtikel(driver);
        await toKegiatan(driver);
        await toPersebaranUMKM(driver);

    } catch (error) {
        console.error(chalk.red("Test SumberDaya Menu failed: ", error));
    }
}


async function toMuseum(driver) {
    try {
        // Tunggu hingga submenu edit museum terlihat
        let museumButton = await driver.wait(until.elementIsVisible(driver.findElement(By.xpath("//a[contains(text(), 'Edit Museum')]"))), 5000);
        await museumButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga navigasi selesai dan halaman selesai dimuat
        await driver.wait(until.urlIs('http://127.0.0.1:8000/admin/museum'), 5000);
        await driver.sleep(3000);

        console.log(chalk.green("Museum Admin Menu test passed"));

        // Klik Toggle Button untuk memunculkan menu admin
        let toogleMenuButton = await driver.findElement(By.id('menu-button'));
        await toogleMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga menu sumber daya terlihat
        let profilButton = await driver.wait(until.elementIsVisible(driver.findElement(By.id('museumSubMenuToggle'))), 5000);
        await profilButton.click();
        await driver.sleep(2000); // Jeda 2 detik

    } catch (error) {
        console.error(chalk.red("Test failed: ", error));
    }
}


async function testMuseum(driver) {
    try {
        // Klik Toggle Button untuk memunculkan menu admin
        let toogleMenuButton = await driver.findElement(By.id('menu-button'));
        await toogleMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga menu Museum terlihat
        let museumButton = await driver.wait(until.elementIsVisible(driver.findElement(By.id('museumSubMenuToggle'))), 5000);
        await museumButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        console.log(chalk.green("SumberDaya Menu test passed"));

        await toMuseum(driver);

    } catch (error) {
        console.error(chalk.red("Test SumberDaya Menu failed: ", error));
    }
}

async function toKontak(driver) {
    try {
        // Tunggu hingga submenu edit museum terlihat
        let kontakButton = await driver.wait(until.elementIsVisible(driver.findElement(By.xpath("//a[contains(text(), 'Edit Kontak')]"))), 5000);
        await kontakButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga navigasi selesai dan halaman selesai dimuat
        await driver.wait(until.urlIs('http://127.0.0.1:8000/admin/kontak'), 5000);
        await driver.sleep(3000);

        console.log(chalk.green("Kontak Admin Menu test passed"));

        // Klik Toggle Button untuk memunculkan menu admin
        let toogleMenuButton = await driver.findElement(By.id('menu-button'));
        await toogleMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga menu sumber daya terlihat
        let MenuButton = await driver.wait(until.elementIsVisible(driver.findElement(By.id('kontakSubMenuToggle'))), 5000);
        await MenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

    } catch (error) {
        console.error(chalk.red("Test failed: ", error));
    }
}


async function testKontak(driver) {
    try {
        // Klik Toggle Button untuk memunculkan menu admin
        let toogleMenuButton = await driver.findElement(By.id('menu-button'));
        await toogleMenuButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        // Tunggu hingga menu Kontak terlihat
        let kontakButton = await driver.wait(until.elementIsVisible(driver.findElement(By.id('kontakSubMenuToggle'))), 5000);
        await kontakButton.click();
        await driver.sleep(2000); // Jeda 2 detik

        console.log(chalk.green("Kontak Menu test passed"));

        await toKontak(driver);

    } catch (error) {
        console.error(chalk.red("Test Kontak Menu failed: ", error));
    }
}



async function test_admin() {
    let driver = await new Builder().forBrowser('chrome').build();

    try {
        await driver.manage().window().maximize();
        await driver.get('http://127.0.0.1:8000');
        await testLogin(driver);
        await testYourProfile(driver)
        await testEditProfile(driver);
        await testEditPassword(driver);

        await testProfil(driver);
        await testSumberDaya(driver);
        await testMuseum(driver);
        await testKontak(driver);

        await testLogout(driver);
        await testBackToBeranda(driver);

    } catch (error) {
        console.error(chalk.red("Test failed: "), error);
    } finally {
        await driver.quit();
    }
}

// Jalankan semua tes
test_admin();
# LastroNote Development Prompts

## Initial Setup and Features
> Bu uygulamada insanlar notlarını ekleyip, görüntüleyip düzenleyebilmeli. Her bir not sadece aktif kullanıcıya ait olacak. Her kullanıcı sadece kendi notlarını görmeli, düzenlemeli ve silebilmeli. Oluşturulacak ana dosyaları (Model, migration gibi) öncelikle artisan komutları ile oluşturup sonra üstüne gereken değişiklikleri uygulayacak şekilde plan yap.

## Navigation and UI
> Giriş yaptıktan sonra ana menüde hâlâ sadece Dashboard görünüyor. Notlar da gelmeli

## Note Creation and Default Directory
> Yeni not yaratmak istediğimde şöyle bir hata veriyor: "Internal Server Error - SQLSTATE[23000]: Integrity constraint violation: 19 NOT NULL constraint failed: notes.directory_id"

## Directory Management
> Notlar çalışıyor. Güzel. Ama şimdi şöyle bir şey istiyorum; notlar dizinlerin içinde bulunsun. Varsayılanda her kullanıcının "Notlarım" diye bir dizini bulunsun ama istediği kadar dizin ekleyip düzenleyebilsin ve silebilsin. Notlar dizinlerin altında oluşturulsun. Soldaki sidebar'da dizinlerin bir listesi görünsün. Her bir dizinin adının sağında "Yeni Not" için bir düğmesi olsun ki notu hangi dizine eklemek istiyorsam ona ekleyebileyim. Soldaki dizin listesindeki elemanların üstüne tıklandığında altındaki notların listesi açılıp kapansın.

## Bug Fixes and Improvements
> Her şeyi sıfırdan kurduğumuzda yeni bir kullanıcı oluşturup Notlarım sayfasına gidince böyle bir hata veriyor: "Attempt to read property 'id' on null"

> create sayfası her yüklendiğinde yeni bir Notlarım dizini yaratıyor. Varolanı okuyamıyor diye herhalde

## Responsive Design
> Sidebar ve içerik alanı mobilde de yan yana geliyor ve responsive çalışmıyor. Mobilde de düzgünce çalışacak hale getirmek lazım

## Documentation
> README.md dosyasını uygun şekilde projeye özel olarak İngilizce içerikle günceller misin?

> readme içinde belirttiğimiz gibi bir de MIT lisans dosyasını projeye ekle
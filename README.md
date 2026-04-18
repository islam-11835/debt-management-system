# Borç Yönetim Sistemi (Laravel)

Bu proje, işletmelerin müşterilerini ve borç kayıtlarını kolayca takip etmeleri için **Laravel** ile geliştirilmiş kapsamlı bir platformdur.

## Öne Çıkan Özellikler:
* **Müşteri Yönetimi:** Yeni müşteri ekleme, silme ve mevcut müşteri listesini yönetme.
* **Borç ve Ödeme Takibi:** Her müşterinin toplam borç miktarını ve yapılan ödemeleri detaylı bir şekilde görüntüleme.
* **İşlem Geçmişi:** Müşteri ismine tıklandığında açılan pencerede; her ödemenin miktarı, tarihi ve saatini içeren "Ödeme Kaydı" (Transaction History).
* **Veri Doğrulama (Validation):** Telefon numarası alanına harf girilmesini engelleyen güvenlik kontrolü ve sayısal tutar doğrulaması.

## Teknik Detaylar:
* **Backend:** PHP 8+ / Laravel
* **Frontend:** Blade Templates, CSS, JavaScript (Modal işlemleri için)
* **Veritabanı:** MySQL (İlişkisel veritabanı yapısı)

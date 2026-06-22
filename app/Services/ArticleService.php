<?php

namespace App\Services;

class ArticleService
{
    public function all(): array
    {
        return $this->getArticles();
    }

    public function findBySlug(string $slug): ?array
    {
        foreach ($this->getArticles() as $article) {
            if ($article['slug'] === $slug) {
                return $article;
            }
        }

        return null;
    }

    public function related(string $currentSlug, int $limit = 3): array
    {
        return array_slice(
            array_values(array_filter($this->getArticles(), fn (array $article) => $article['slug'] !== $currentSlug)),
            0,
            $limit
        );
    }

    private function getArticles(): array
    {
        $image = 'storage/images/hero.png';

        return [
            [
                'slug' => 'keutamaan-shalat',
                'title' => 'Keutamaan Shalat',
                'excerpt' => 'Shalat adalah tiang agama dan ibadah harian yang menjaga hubungan seorang hamba dengan Allah.',
                'author' => 'Takmir Masjid Al-Firdaus',
                'published_at' => '10 Juni 2026',
                'thumbnail' => $image,
                'content' => [
                    'Shalat memiliki kedudukan yang sangat agung dalam Islam. Ia menjadi pembeda utama antara seorang muslim yang menjaga agamanya dengan kelalaian yang menjauhkan hati dari Allah.',
                    'Melalui shalat, seorang hamba belajar disiplin, tunduk, dan kembali mengingat tujuan hidupnya. Waktu-waktu shalat yang tersebar sepanjang hari menjadi pengingat agar aktivitas dunia tidak membuat hati lupa kepada Sang Pencipta.',
                    'Menjaga shalat berjamaah juga menguatkan ukhuwah. Di masjid, jamaah saling bertemu, saling mengenal, dan saling mendoakan dalam kebaikan.',
                ],
            ],
            [
                'slug' => 'adab-menuntut-ilmu',
                'title' => 'Adab Menuntut Ilmu',
                'excerpt' => 'Ilmu agama perlu dicari dengan niat yang ikhlas, hati yang tawadhu, dan adab kepada guru.',
                'author' => 'Takmir Masjid Al-Firdaus',
                'published_at' => '11 Juni 2026',
                'thumbnail' => $image,
                'content' => [
                    'Menuntut ilmu adalah jalan mulia untuk mengenal Allah, memahami ibadah, dan memperbaiki akhlak. Namun ilmu yang berkah tidak hanya dicari dengan kecerdasan, melainkan juga dengan adab.',
                    'Di antara adab penuntut ilmu adalah meluruskan niat, menghormati guru, bersabar dalam proses belajar, dan mengamalkan ilmu sedikit demi sedikit.',
                    'Ilmu yang diamalkan akan menjadi cahaya. Karena itu, kajian dan majelis ilmu hendaknya tidak berhenti pada catatan, tetapi hadir dalam perilaku sehari-hari.',
                ],
            ],
            [
                'slug' => 'keutamaan-sedekah',
                'title' => 'Keutamaan Sedekah',
                'excerpt' => 'Sedekah membersihkan harta, melembutkan hati, dan menjadi sebab hadirnya keberkahan.',
                'author' => 'Takmir Masjid Al-Firdaus',
                'published_at' => '12 Juni 2026',
                'thumbnail' => $image,
                'content' => [
                    'Sedekah adalah ibadah yang menunjukkan kepedulian seorang muslim kepada sesama. Ia tidak selalu harus besar, tetapi hendaknya diberikan dengan ikhlas dan dari harta yang baik.',
                    'Dengan sedekah, hati dilatih untuk tidak terlalu melekat pada dunia. Seorang muslim belajar bahwa harta adalah amanah yang perlu digunakan untuk kebaikan.',
                    'Sedekah juga menguatkan kehidupan sosial jamaah. Ketika yang lapang membantu yang membutuhkan, masyarakat menjadi lebih hangat dan saling menopang.',
                ],
            ],
            [
                'slug' => 'birrul-walidain',
                'title' => 'Birrul Walidain',
                'excerpt' => 'Berbakti kepada orang tua adalah pintu kebaikan yang besar dan tanda indahnya akhlak seorang muslim.',
                'author' => 'Takmir Masjid Al-Firdaus',
                'published_at' => '13 Juni 2026',
                'thumbnail' => $image,
                'content' => [
                    'Birrul walidain berarti berbuat baik kepada kedua orang tua dengan ucapan, sikap, bantuan, dan doa. Islam menempatkan bakti kepada orang tua pada kedudukan yang sangat tinggi.',
                    'Bakti kepada orang tua tidak berhenti ketika seorang anak sudah dewasa. Justru semakin bertambah usia, semakin besar pula kebutuhan untuk menjaga tutur kata dan perhatian kepada mereka.',
                    'Di antara bentuk bakti yang terus hidup adalah mendoakan orang tua, menyambung silaturahmi mereka, dan menjaga nama baik keluarga dengan akhlak yang mulia.',
                ],
            ],
            [
                'slug' => 'menjaga-lisan',
                'title' => 'Menjaga Lisan',
                'excerpt' => 'Lisan yang terjaga dapat menyelamatkan hati, menjaga persaudaraan, dan menghadirkan ketenangan.',
                'author' => 'Takmir Masjid Al-Firdaus',
                'published_at' => '14 Juni 2026',
                'thumbnail' => $image,
                'content' => [
                    'Lisan adalah nikmat besar yang dapat membawa kebaikan atau keburukan. Dengan lisan, seseorang dapat berdzikir, menasihati, dan menghibur. Namun dengan lisan pula seseorang dapat menyakiti.',
                    'Menjaga lisan berarti berpikir sebelum berbicara. Apakah ucapan itu benar, bermanfaat, dan disampaikan dengan cara yang baik.',
                    'Di tengah kehidupan bermasyarakat, lisan yang lembut dan jujur menjadi sebab terjaganya persaudaraan. Banyak masalah dapat dicegah ketika seorang muslim memilih kata dengan bijak.',
                ],
            ],
            [
                'slug' => 'keutamaan-membaca-al-quran',
                'title' => "Keutamaan Membaca Al-Qur'an",
                'excerpt' => "Al-Qur'an adalah petunjuk hidup, penenang hati, dan sumber cahaya bagi keluarga muslim.",
                'author' => 'Takmir Masjid Al-Firdaus',
                'published_at' => '15 Juni 2026',
                'thumbnail' => $image,
                'content' => [
                    "Membaca Al-Qur'an adalah ibadah yang menghadirkan ketenangan dan pahala. Setiap ayat mengandung petunjuk bagi manusia agar hidupnya lebih terarah.",
                    "Kedekatan dengan Al-Qur'an tidak hanya melalui bacaan, tetapi juga dengan memahami makna dan berusaha mengamalkannya dalam kehidupan.",
                    "Rumah yang dibiasakan dengan tilawah akan terasa lebih hidup. Karena itu, setiap keluarga muslim dianjurkan menjadikan Al-Qur'an sebagai bagian dari keseharian.",
                ],
            ],
        ];
    }
}

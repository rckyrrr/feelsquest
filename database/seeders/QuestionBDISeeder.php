<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\TestQuestion;
use Illuminate\Support\Str;

class QuestionBDISeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $test = new Test();
        $test->test_uuid =  str_replace('-', '', substr(Str::uuid(), 0, 16));
        $test->name = 'Test Tingkat Depresi';
        $test->description = 'Untuk kamu yang ingin mengetahui tingkat depresi kamu';
        $test->icon = 'Tes BDI.png';
        $test->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak merasa sedih.', 'value' => 0],
            1 => ['label' => 'Saya merasa sedih', 'value' => 1],
            2 => ['label' => 'Saya sedih sepanjang waktu dan saya tidak bisa lepas dari kesedihan.', 'value' => 2],
            3 => ['label' => 'Saya sangat sedih dan tidak bahagia hingga tidak sanggup menahannya', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak terlalu khawatir tentang masa depan.', 'value' => 0],
            1 => ['label' => 'Saya merasa tidak optimis dengan masa depan.', 'value' => 1],
            2 => ['label' => 'Saya merasa tidak ada yang bisa diharapkan.', 'value' => 2],
            3 => ['label' => 'Saya merasa masa depan tanpa ada harapan dan segala sesuatunya tidak akan membaik.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak merasa gagal.', 'value' => 0],
            1 => ['label' => 'Saya merasa saya telah gagal dibanding orang-orang pada umumnya.', 'value' => 1],
            2 => ['label' => 'Ketika saya melihat kembali kehidupan saya, yang saya lihat hanyalah kegagalan.', 'value' => 2],
            3 => ['label' => 'Saya merasa saya benar-benar gagal sebagai seorang manusia.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak mendapatkan kepuasan yang sama seperti dulu.', 'value' => 0],
            1 => ['label' => 'Saya tidak menikmati hal-hal seperti dulu.', 'value' => 1],
            2 => ['label' => 'Saya tidak lagi mendapatkan kepuasan yang nyata dari apa pun.', 'value' => 2],
            3 => ['label' => 'Saya merasa tidak puas atau bosan dengan segala sesuatu.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak merasa benar-benar bersalah', 'value' => 0],
            1 => ['label' => 'Saya merasa bersalah hampir sepanjang waktu.', 'value' => 1],
            2 => ['label' => 'Saya merasa agak bersalah hampir sepanjang waktu.', 'value' => 2],
            3 => ['label' => 'Saya merasa bersalah sepanjang waktu.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak merasa sedang dihukum.', 'value' => 0],
            1 => ['label' => 'Saya merasa saya mungkin dihukum.', 'value' => 1],
            2 => ['label' => 'Saya berharap untuk dihukum.', 'value' => 2],
            3 => ['label' => 'Saya merasa saya sedang dihukum.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak merasa kecewa dengan diri saya sendiri.', 'value' => 0],
            1 => ['label' => 'Saya kecewa dengan diri saya sendiri.', 'value' => 1],
            2 => ['label' => 'Saya merasa malu dengan diri saya sendiri.', 'value' => 2],
            3 => ['label' => 'Saya membenci diri saya sendiri.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak merasa saya lebih buruk dari orang lain.', 'value' => 0],
            1 => ['label' => 'Saya bersikap kritis terhadap diri saya sendiri atas kelemahan atau kesalahan saya.', 'value' => 1],
            2 => ['label' => 'Saya menyalahkan diri sendiri sepanjang waktu atas kesalahan saya.', 'value' => 2],
            3 => ['label' => 'Saya menyalahkan diri sendiri untuk semua hal buruk yang terjadi.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak memiliki pikiran untuk bunuh diri.', 'value' => 0],
            1 => ['label' => 'Saya memiliki pikiran untuk bunuh diri, tetapi saya tidak akan melakukannya.', 'value' => 1],
            2 => ['label' => 'Saya ingin bunuh diri.', 'value' => 2],
            3 => ['label' => 'Saya akan bunuh diri jika ada kesempatan.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak menangis lebih dari biasanya.', 'value' => 0],
            1 => ['label' => 'Saya lebih sering menangis sekarang daripada dulu.', 'value' => 1],
            2 => ['label' => 'Saya menangis sepanjang waktu sekarang.', 'value' => 2],
            3 => ['label' => 'Dulu saya bisa menangis, tetapi sekarang saya tidak bisa menangis meskipun saya ingin menangis.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak lagi kesal dengan berbagai hal dibandingkan sebelumnya.', 'value' => 0],
            1 => ['label' => 'Saya merasa sedikit lebih kesal sekarang daripada biasanya.', 'value' => 1],
            2 => ['label' => 'Saya merasa cukup jengkel atau kesal hampir sepanjang waktu.', 'value' => 2],
            3 => ['label' => 'Saya merasa jengkel sepanjang waktu.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak kehilangan ketertarikan pada orang lain.', 'value' => 0],
            1 => ['label' => 'Saya kurang tertarik pada orang lain dibandingkan dulu.', 'value' => 1],
            2 => ['label' => 'Saya telah kehilangan sebagian besar ketertarikan saya pada orang lain.', 'value' => 2],
            3 => ['label' => 'Saya telah kehilangan semua ketertarikan saya pada orang lain.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya membuat keputusan sebaik yang saya bisa.', 'value' => 0],
            1 => ['label' => 'Saya lebih sering menunda membuat keputusan daripada biasanya.', 'value' => 1],
            2 => ['label' => 'Saya mengalami kesulitan yang lebih besar dalam membuat keputusan dibandingkan sebelumnya.', 'value' => 2],
            3 => ['label' => 'Saya tidak dapat membuat keputusan sama sekali.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak merasa penampilan saya lebih buruk dari biasanya.', 'value' => 0],
            1 => ['label' => 'Saya khawatir saya terlihat tua atau tidak menarik.', 'value' => 1],
            2 => ['label' => 'Saya merasa ada perubahan permanen pada penampilan saya yang membuat saya terlihat tidak menarik.', 'value' => 2],
            3 => ['label' => 'Saya percaya bahwa saya terlihat jelek.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya dapat bekerja sebaik sebelumnya.', 'value' => 0],
            1 => ['label' => 'Dibutuhkan usaha ekstra untuk memulai melakukan sesuatu.', 'value' => 1],
            2 => ['label' => 'Saya harus mendorong diri saya sendiri dengan sangat keras untuk melakukan sesuatu.', 'value' => 2],
            3 => ['label' => 'Saya tidak bisa melakukan pekerjaan sama sekali.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya bisa tidur nyenyak seperti biasa.', 'value' => 0],
            1 => ['label' => 'Saya tidak bisa tidur nyenyak seperti biasanya.', 'value' => 1],
            2 => ['label' => 'Saya bangun 1-2 jam lebih awal dari biasanya dan sulit untuk kembali tidur.', 'value' => 2],
            3 => ['label' => 'Saya bangun beberapa jam lebih awal dari biasanya dan tidak bisa kembali tidur.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak merasa lebih lelah dari biasanya.', 'value' => 0],
            1 => ['label' => 'Saya lebih mudah lelah daripada biasanya.', 'value' => 1],
            2 => ['label' => 'Saya kelelahan setelah melakukan apapun.', 'value' => 2],
            3 => ['label' => 'Saya terlalu lelah untuk melakukan apapun.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Nafsu makan saya tidak lebih buruk dari biasanya.', 'value' => 0],
            1 => ['label' => 'Nafsu makan saya tidak sebagus biasanya.', 'value' => 1],
            2 => ['label' => 'Nafsu makan saya jauh lebih buruk sekarang.', 'value' => 2],
            3 => ['label' => 'Saya tidak punya nafsu makan sama sekali.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Berat badan saya tidak turun banyak, jika ada, akhir-akhir ini.', 'value' => 0],
            1 => ['label' => 'Saya telah kehilangan lebih dari 2 kilo.', 'value' => 1],
            2 => ['label' => 'Saya telah kehilangan lebih dari 4 kilo.', 'value' => 2],
            3 => ['label' => 'Saya telah kehilangan lebih dari 6 kg.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak lagi mengkhawatirkan kesehatan saya seperti biasanya.', 'value' => 0],
            1 => ['label' => 'Saya khawatir tentang masalah fisik seperti sakit, nyeri, sakit perut, atau masalah fisik lainnya.', 'value' => 1],
            2 => ['label' => 'Saya sangat khawatir dengan masalah fisik dan sulit untuk memikirkan hal lain.', 'value' => 2],
            3 => ['label' => 'Saya sangat khawatir dengan masalah fisik saya sehingga saya tidak dapat memikirkan hal lain.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = '';
        $bai->answer = json_encode([
            0 => ['label' => 'Saya tidak melihat adanya perubahan dalam minat saya terhadap hubungan seksual.', 'value' => 0],
            1 => ['label' => 'Saya kurang tertarik pada hubungan seksual dibandingkan dulu.', 'value' => 1],
            2 => ['label' => 'Saya hampir tidak tertarik pada hubungan seksual.', 'value' => 2],
            3 => ['label' => 'Saya telah kehilangan minat pada hubungan seksual sama sekali.', 'value' => 3],
        ]);
        $bai->test_id = 3;
        $bai->save();
    }
}

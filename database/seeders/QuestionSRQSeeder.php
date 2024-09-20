<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\TestQuestion;
use Illuminate\Support\Str;

class QuestionSRQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $test = new Test();
        $test->test_uuid =  str_replace('-', '', substr(Str::uuid(), 0, 16));
        $test->name = 'Test Kondisi Mental';
        $test->description = 'untuk kamu yang bingung dengan kondisi mental kamu, yuk cek dulu!';
        $test->icon = 'Tes SRQ.png';
        $test->save();

        $bai = new TestQuestion();
        $bai->question = 'Sering merasa kepala pusing?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Lagi kehilangan selera makan, nih?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Sering tidur gak nyenyak?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Pernah merasa takut-takut tanpa alasan yang jelas?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Sering khawatir, cemas, atau tegang?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Tangan sering gemetar tanpa alasan yang jelas, ya?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Pernah mengalami masalah pencernaan kayak mual-mual, muntah, atau diare?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Sering susah fokus atau pikiran gak jernih?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Udah lama gak bahagia ya?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Pernah nangis-nangis belakangan ini?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Kesulitan menikmati aktivitas biasa yang dulu kamu suka?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Beberapa kali bingung milih-milih keputusan?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Ngerasa kesulitan ngurusin tugas-tugas sehari-hari yang biasanya gampang?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Merasa gak berguna atau gak bisa berkontribusi dalam hidup?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Udah gak tertarik lagi sama hal-hal yang biasanya kamu suka?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Merasa minder atau merendahkan diri sendiri?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Ada pikiran atau niatan buat berhenti hidup?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Selalu capek atau gak ada tenaga terus-menerus?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Sering gak enak atau sakit perut?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Mudah lelah meski gak ngapa-ngapain berat-berat?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Apakah kamu pernah mengkonsumsi alkohol atau menggunakan narkoba secara berlebihan?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Pernah ngerasa ada orang yang nyari masalah sama kamu atau ngerasa ada yang ngelakuin sesuatu yang aneh ke kamu?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Ada gangguan pikiran atau hal-hal aneh yang meresahkan?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Pernah denger suara-suara yang gak jelas asalnya atau suara yang cuma kamu denger?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Suka mimpi buruk tentang bencana atau merasa kayak ngalamin lagi kejadian yang serem?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Apakah kamu mencoba menghindari hal-hal yang mengingatkanmu pada bencana atau yang bikin kamu gak enak?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Udah kurang tertarik sama temen-temen dan hal-hal yang biasanya kamu suka?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Kerasa banget terganggu kalo lagi di situasi yang nyeritain kejadian bencana?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Susah banget deh buat ngertiin atau ngungkapin perasaan kamu?';
        $bai->answer = $bai->answer = json_encode([
            0 => ['label' => 'Tidak', 'value' => 0],
            1 => ['label' => 'Ya', 'value' => 1],
        ]);
        $bai->test_id = 2;
        $bai->save();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\TestQuestion;
use Illuminate\Support\Str;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $test = new Test();
        $test->test_uuid =  str_replace('-', '', substr(Str::uuid(), 0, 16));
        $test->name = 'Test Tingkat Kecemasan';
        $test->description = 'Untuk kamu yang ingin mengetahui tingkat kecemasan kamu';
        $test->icon = 'Tes BAI.png';
        $test->save();

        $bai = new TestQuestion();
        $bai->question = 'Mati rasa atau kesemutan';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Merasa panas';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Goyah pada kaki';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Tidak dapat bersantai';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Takut akan hal terburuk yang terjadi';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Pusing';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Jantung berdebar-debar';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Goyah';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Ketakutan';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Gugup';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Perasaan seperti tersedak';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Tangan gemetar';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Gemetar';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Takut kehilangan kendali';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Kesulitan bernapas';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Takut akan kematian';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Merasa ketakutan';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Gangguan pencernaan';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Lelah';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Wajah memerah';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();

        $bai = new TestQuestion();
        $bai->question = 'Keringat panas/dingin';
        $bai->answer = json_encode([
            0 => ['label' => 'Tidak Sama Sekali', 'value' => 0],
            1 => ['label' => 'Sedikit tapi tidak mengganggu', 'value' => 1],
            2 => ['label' => 'Lumayan, itu cukup mengganggu di beberapa waktu', 'value' => 2],
            3 => ['label' => 'Sering', 'value' => 3]
        ]);
        $bai->test_id = 1;
        $bai->save();
    }
}

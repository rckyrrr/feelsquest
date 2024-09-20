<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\package;
use App\Models\User;
use App\Models\Feature;
use App\Models\QOTD;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = new User();
        $user->uuid = str_replace('-', '', substr(Str::uuid(), 0, 16));
        $user->name = 'Admin';
        $user->slug_user = trim('Admin');
        $user->phone_number = '0123123123312';
        $user->email = 'mahardikahando.k.o@gmail.com';
        $user->user_type = 'superadmin';
        $user->status_user = 'active';
        $user->save();

        $user = new User();
        $user->uuid = str_replace('-', '', substr(Str::uuid(), 0, 16));
        $user->name = 'mahardika';
        $user->slug_user = trim('Konselor 1');
        $user->phone_number = '012312312312';
        $user->email = 'mahardikahandok.o@gmail.com';
        $user->user_type = 'konselor';
        $user->foto = 'Konselor 2.png';
        $user->umur = 43;
        $user->nama_depan = 'Mahardika';
        $user->nama_belakang = 'Handoko';
        $user->bahasa = 'Indonesia';
        $user->gender = 'Pria';
        $user->izin_konselor = '12323123hbd218';
        $user->npwp = '213123123123';
        $user->keahlian_utama = 'Keluarga';
        $user->keahlian_lainnya = 'awdawdadawdawd';
        $user->pendekatan = 'Pendekatan A';
        $user->status_user = 'active';
        $user->save();

        $user = new User();
        $user->uuid = str_replace('-', '', substr(Str::uuid(), 0, 16));
        $user->name = 'Konselor 2';
        $user->slug_user = trim('Konselor 2');
        $user->phone_number = '0123123123312';
        $user->email = 'konselor2@gmail.com';
        $user->user_type = 'konselor';
        $user->foto = 'Konselor 1.png';
        $user->umur = 43;
        $user->nama_depan = 'Konselor';
        $user->nama_belakang = '2';
        $user->bahasa = 'Indonesia';
        $user->gender = 'Wanita';
        $user->izin_konselor = '12323123hbd218';
        $user->npwp = '213123123123';
        $user->keahlian_utama = 'Keluarga';
        $user->keahlian_lainnya = 'awdawdadawdawd';
        $user->pendekatan = 'Pendekatan A';
        $user->status_user = 'active';
        $user->save();

        $user = new User();
        $user->uuid = str_replace('-', '', substr(Str::uuid(), 0, 16));
        $user->name = 'Mahardika';
        $user->slug_user = trim('Mahardika');
        $user->phone_number = '0123123123312';
        $user->email = 'mahardikahandoko@gmail.com';
        $user->user_type = 'user';
        $user->status_user = 'active';
        $user->save();

        $user = new User();
        $user->uuid = str_replace('-', '', substr(Str::uuid(), 0, 16));
        $user->name = 'Testing';
        $user->slug_user = trim('Mahardika');
        $user->phone_number = '0123123123312';
        $user->email = 'testing@gmail.com';
        $user->user_type = 'user';
        $user->status_user = 'active';
        $user->save();

        $feature = new Feature();
        $feature->name = 'Fitur 1';
        $feature->description = 'Testing';
        $feature->icon = 'Testing Icon.jpg';
        $feature->status_feature = 'active';
        $feature->save();

        $feature = new Feature();
        $feature->name = 'Fitur 2';
        $feature->description = 'Testing';
        $feature->icon = 'Testing Icon.jpg';
        $feature->status_feature = 'active';
        $feature->save();

        $features = Feature::whereIn('id', [1, 2])->get();

        $package = new package();
        $package->admin_id = 3;
        $package->packageUUID = str_replace('-', '', substr(Str::uuid(), 0, 16));
        $package->name = 'Paket 1';
        $package->description = 'Paket 1 merupakan paket starter';
        $package->total_sessions = 3;
        $package->price = 100000;
        $package->status_package = 'active';
        $package->save();

        $package->features()->attach($features, ['package_id' => $package->id]);

        $qotd = new QOTD();
        $qotd->admin_id = 1;
        $qotd->qotd = 'Semangat Bang';
        $qotd->save();

        $this->call([QuestionSeeder::class]);
        $this->call([QuestionSRQSeeder::class]);
        $this->call([QuestionBDISeeder::class]);
    }
}

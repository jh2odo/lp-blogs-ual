<?php

class UserTableSeeder extends Seeder
{

    public function run()
    {
    	DB::table('users')->delete();
        
        // Uncomment the below to wipe the table clean before populating
        // DB::table('users')->truncate();

        $user = array(
            'username' => 'aguado',
            'password' => Hash::make('aguado'),
        	'email' => 'aguado@aguado.com',
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        );

        // Comment the below to stop the seeder
        DB::table('users')->insert($user);
    }

}

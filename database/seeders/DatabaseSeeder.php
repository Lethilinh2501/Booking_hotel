<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // UserSeeder::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            AboutSeeder::class,
            AmenitySeeder::class,
            BannerSeeder::class,
            ContactSeeder::class,
            FaqSeeder::class,
            UserSeeder::class,
            GuestSeeder::class,
            RoomTypeSeeder::class,
            RoomSeeder::class,
            ServiceSeeder::class,
            RoomTypeServiceSeeder::class,
            BookingSeeder::class,
            BookingRoomSeeder::class,
            BookingGuestSeeder::class,
            PromotionSeeder::class,
            BookingPromotionSeeder::class,
            PaymentSeeder::class,
            RefundSeeder::class,
            RefundTransactionSeeder::class,
            ReviewSeeder::class,
            RestaurantSeeder::class,
            RuleAndRegulationSeeder::class,
            StaffRoleSeeder::class,
            StaffSeeder::class,
            StaffAttendanceSeeder::class,
            StaffShiftSeeder::class,
            RoomTypeAmenitySeeder::class,
            RoomTypeImageSeeder::class,
            RoomTypeRarSeeder::class,
            SaleRoomTypeSeeder::class,
            SettingSeeder::class,
            LogSeeder::class,
            PostCategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}

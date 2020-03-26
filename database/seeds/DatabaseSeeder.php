<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(FB_api_mode::class);
        $this->call(FB_page_edge::class);
        $this->call(FB_field::class);
        $this->call(FB_page_edge_node::class);
        $this->call(FB_edge_edgeNode::class);
        $this->call(FB_field_followingrequest::class);
        $this->call(FB_parent_field::class);
        $this->call(Provider::class);
        $this->call(User::class);
        $this->call(News::class);
        $this->call(InfoApiCost::class);
        $this->call(MediaApiCost::class);
        $this->call(ForumSection::class);
        $this->call(CheckoutFlow::class);
        $this->call(ApiDiscount::class);
        $this->call(UserPayment::class);
        $this->call(FB_api_group_full_mode_and_statistics::class);

        Model::reguard();
    }
}

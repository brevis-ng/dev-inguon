<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListfilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listfilms', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('vod_id');
            $table->integer('type_id');
            $table->integer('type_id_1');
            $table->integer('group_id');
            $table->string('vod_name');
            $table->string('vod_sub');
            $table->string('vod_en');
            $table->integer('vod_status');
            $table->char('vod_letter');
            $table->string('vod_color');
            $table->string('vod_tag');
            $table->string('vod_class');
            $table->string('vod_pic');
            $table->string('vod_pic_thumb');
            $table->string('vod_pic_slide');
            $table->text('vod_pic_screenshot');
            $table->string('vod_actor');
            $table->string('vod_director');
            $table->string('vod_writer');
            $table->string('vod_behind');
            $table->string('vod_blurb');
            $table->string('vod_remarks');
            $table->string('vod_pubdate');
            $table->integer('vod_total');
            $table->string('vod_serial');
            $table->string('vod_tv');
            $table->string('vod_weekday');
            $table->string('vod_area');
            $table->string('vod_lang');
            $table->string('vod_year');
            $table->string('vod_version');
            $table->string('vod_state');
            $table->string('vod_author');
            $table->string('vod_jumpurl');
            $table->string('vod_tpl');
            $table->string('vod_tpl_play');
            $table->string('vod_tpl_down');
            $table->integer('vod_isend');
            $table->integer('vod_lock');
            $table->integer('vod_level');
            $table->integer('vod_copyright');
            $table->integer('vod_points');
            $table->integer('vod_points_play');
            $table->integer('vod_points_down');
            $table->integer('vod_hits');
            $table->integer('vod_hits_day');
            $table->integer('vod_hits_week');
            $table->integer('vod_hits_month');
            $table->string('vod_duration');
            $table->integer('vod_up');
            $table->integer('vod_down');
            $table->decimal('vod_score', 3, 1);
            $table->integer('vod_score_all');
            $table->integer('vod_score_num');
            $table->string('vod_time');
            $table->integer('vod_time_add');
            $table->integer('vod_time_hits');
            $table->integer('vod_time_make');
            $table->integer('vod_trysee');
            $table->integer('vod_douban_id');
            $table->decimal('vod_douban_score', 3, 1);
            $table->string('vod_reurl');
            $table->string('vod_rel_vod');
            $table->string('vod_rel_art');
            $table->string('vod_pwd');
            $table->string('vod_pwd_url');
            $table->string('vod_pwd_play');
            $table->string('vod_pwd_play_url');
            $table->string('vod_pwd_down');
            $table->string('vod_pwd_down_url');
            $table->text('vod_content');
            $table->string('vod_play_from');
            $table->string('vod_play_server');
            $table->string('vod_play_note');
            $table->text('vod_play_url');
            $table->string('vod_down_from');
            $table->string('vod_down_server');
            $table->string('vod_down_note');
            $table->text('vod_down_url');
            $table->integer('vod_plot');
            $table->text('vod_plot_name');
            $table->text('vod_plot_detail');
            $table->string('type_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listfilms');
    }
}

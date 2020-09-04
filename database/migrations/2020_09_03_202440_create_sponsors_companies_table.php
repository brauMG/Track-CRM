<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors_companies', function (Blueprint $table) {
            $table->increments('sponsorCompanyId');
            $table->integer('sponsorId')->unsigned();
            $table->integer('companyId')->unsigned();

            $table->foreign('sponsorId')->references('sponsorId')->on('sponsors')->onDelete('cascade');
            $table->foreign('companyId')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsors_companies');
    }
}

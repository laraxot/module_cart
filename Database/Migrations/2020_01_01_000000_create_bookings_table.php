<?php

use Illuminate\Database\Schema\Blueprint;
//----- bases ----
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateBookingsTable
 */
class CreateBookingsTable extends XotBaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //-- CREATE --
        if (! $this->tableExists()) {
            $this->getConn()->create(
                $this->getTable(),
                function (Blueprint $table) {
                    $table->increments('id');
                    $table->nullableMorphs('shop');
                    $table->integer('booking_item_id')->nullable();
                    $table->integer('guest_num')->nullable();
                    $table->integer('occasion_id')->nullable();
                    $table->integer('customer_id')->nullable();
                    $table->string('first_name', 45)->nullable();
                    $table->string('last_name', 45)->nullable();
                    $table->string('email', 96)->nullable();
                    $table->string('telephone', 45)->nullable();
                    $table->text('note')->nullable();
                    $table->time('reserve_time')->nullable();
                    $table->date('reserve_date')->nullable();
                    $table->date('date_added')->nullable();
                    $table->date('date_modified')->nullable();
                    $table->integer('assignee_id')->nullable();
                    $table->boolean('notify')->nullable();
                    $table->string('ip_address', 40)->nullable();
                    $table->string('user_agent')->nullable();
                    $table->integer('status')->nullable();
                    $table->string('created_by')->nullable();
                    $table->string('updated_by')->nullable();
                    $table->timestamps();
                }
            );
        }
        //-- UPDATE --
        $this->getConn()->table(
            $this->getTable(),
            function (Blueprint $table) {
                //if (! $this->hasColumn('price_complete')) {
            //    $table->decimal('price_complete', 10, 3)->nullable();
            //}
            }
        );
    }//end function up
}//end class

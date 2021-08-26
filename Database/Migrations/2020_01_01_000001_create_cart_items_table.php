<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
//----- bases ----
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateCartItemsTable.
 */
class CreateCartItemsTable extends XotBaseMigration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //-- CREATE --
        if (! $this->tableExists()) {
            $this->getConn()->create($this->getTable(), function (Blueprint $table) {
                $table->increments('id');
                $table->integer('cart_id');
                $table->integer('status')->nullable();
                $table->integer('auth_user_id')->nullable();
                $table->text('note')->nullable();
                $table->integer('qty');
                $table->decimal('price', 10, 3);
                $table->decimal('price_complete', 10, 3)->nullable();

                $table->nullableMorphs('post');
                //$table->string('related_type', 50)->index()->nullable();//non serve in teoria
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->string('deleted_by')->nullable();
                $table->timestamps();
            });
        }
        //-- UPDATE --
        $this->getConn()->table($this->getTable(), function (Blueprint $table) {
            if (! $this->hasColumn('cart_id')) {
                $table->integer('cart_id')->after('id')->nullable();
            }
            if (! $this->hasColumn('title')) {
                $table->string('title')->after('auth_user_id')->nullable();
                $table->string('subtitle')->after('title')->nullable();
            }
            if (! $this->hasColumn('pivot_id')) {
                $table->integer('pivot_id')->nullable();
            }
            if (! $this->hasColumn('price')) {
                $table->decimal('price', 10, 3)->nullable();
            }

            if (! $this->hasColumn('price_complete')) {
                $table->decimal('price_complete', 10, 3)->nullable();
            }

            if (! $this->hasColumn('shop_id')) {
                $table->nullableMorphs('shop');
                $table->string('shop_title')->nullable();
                $table->nullableMorphs('item');
                $table->string('item_title')->nullable();
            }
            if ($this->hasColumn('post_id')) {
                $table->dropColumn(['post_id', 'post_type']);
            }

            if (! $this->hasColumn('currency')) {
                $table->string('currency', 3)->nullable();
            }
        });
    }

    //end up
}//end class

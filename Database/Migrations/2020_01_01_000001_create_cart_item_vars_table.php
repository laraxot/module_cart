<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
//----- bases ----
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateCartItemVarsTable.
 */
class CreateCartItemVarsTable extends XotBaseMigration {
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
                $table->integer('cart_item_id');
                $table->integer('status')->nullable();
                $table->integer('user_id')->nullable();
                $table->integer('qty')->nullable();
                $table->decimal('price', 10, 3)->nullable();
                $table->integer('pivot_id')->nullable();
                $table->text('note')->nullable();

                $table->nullableMorphs('post');
                $table->string('title')->nullable();
                $table->string('subtitle')->nullable();
                //$table->string('related_type', 50)->index()->nullable();//non serve in teoria
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->string('deleted_by')->nullable();
                $table->timestamps();
            });
        }
        //-- UPDATE --
        $this->getConn()->table($this->getTable(), function (Blueprint $table) {
            if (! $this->hasColumn('var_cat_type')) {
                $table->nullableMorphs('var_cat');
                $table->string('var_cat_title')->nullable();

                $table->nullableMorphs('var_item');
                $table->string('var_item_title')->nullable();
            }
            if ($this->hasColumn('post_id')) {
                $table->dropColumn(['post_id', 'post_type', 'title', 'subtitle']);
            }
            if ($this->hasColumn('auth_user_id')) {
                $table->renameColumn('auth_user_id', 'user_id');
            }
        });
    }
}

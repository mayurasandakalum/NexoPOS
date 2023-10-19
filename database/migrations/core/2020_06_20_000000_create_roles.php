<?php
/**
 * Table Migration
**/
use App\Models\Role;
use App\Services\Options;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Determine whether the migration
     * should execute when we're accessing
     * a multistore instance.
     */
    public function runOnMultiStore()
    {
        return false;
    }

    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        $this->options = app()->make( Options::class );

        /**
         * Each of the following files will define a role
         * and permissions that are assigned to those roles.
         */
        include_once dirname( __FILE__ ) . '/../../permissions/user-role.php';
        include_once dirname( __FILE__ ) . '/../../permissions/admin-role.php';
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        // ...
    }
};

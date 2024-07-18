use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id('group_id');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('set null');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
}

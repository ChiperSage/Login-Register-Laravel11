use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('username', 100)->unique();
            $table->string('password');
            $table->integer('login_attempts')->default(0);
            $table->integer('last_login_attempt')->default(0);
            $table->string('remember_me_token', 255)->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();

            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('set null');
            $table->foreign('group_id')->references('group_id')->on('groups')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

<?

namespace App\Laratables;
use Freshbitsweb\Laratables\Laratables;
use App\Models\Task;

class TaskLaratable
{
    public static function laratablesCustomAction($task)
    {
        echo 'laratablesCustomAction';
        $data = array(
            'title' => $task->title,
            'description' => $task->description,
            'due_date' => $task->due_date,
            'status' => $task->status,
            'empleado_id' => $task->empleado->nombres
        );
        return $data;
    }

    public static function laratablesQueryConditions($query)
    {
        return $query->with('empleado');
    }
}

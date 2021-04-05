<?php


namespace App\Services;

use App\Models\Task;
use \Illuminate\Http\Request;

class TaskService
{

    /**
     * Save task with check page
     *
     * @param Request $request
     * @param array $typeData
     * @return Task
     */

    public static function storeTask(Request $request, array $typeData = []): Task
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth('api')->user()->id;
        $requestData['due_date'] = date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->time . ''));
        $requestData['display_name'] = '(' . $request->name . ')';

        if (!empty($typeData)) {
            switch ($typeData['type']) {
                case 'lead':
                    $requestData['lead'] = $typeData['value'];
                    break;
                case 'project':
                    $requestData['project'] = $typeData['value'];
                    break;
                case 'subcontractor':
                    $requestData['subcontractor'] = $typeData['value'];
                    break;
            }
        }

        return Task::create($requestData);
    }

    /**
     * Make data for page
     *
     * @param string $type
     * @param int $id
     * @return array
     */

    public static function buildTypeData(string $type, int $id): array
    {
        $typeData = [];

        if ($type) {
            switch ($type) {
                case 'lead':
                    $typeData = [
                        'type' => 'lead',
                        'value' => $id,
                    ];
                    break;
                case 'project':
                    $typeData = [
                        'type' => 'project',
                        'value' => $id,
                    ];
                    break;
                case 'subcontractor':
                    $typeData = [
                        'type' => 'subcontractor',
                        'value' => $id,
                    ];
                    break;
            }
        }

        return $typeData;
    }
}
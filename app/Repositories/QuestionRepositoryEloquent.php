<?php

namespace App\Repositories;

use App\Models\Leads;
use App\Models\Remark;
use App\Models\RemarkFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\QuestionRepository;
use App\Models\Question;
use App\Validators\QuestionValidator;

/**
 * Class QuestionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class QuestionRepositoryEloquent extends BaseRepository implements QuestionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Question::class;
    }

    /**
     * @param Leads|null $lead
     * @return mixed
     */
    public function getLeadQuestions(?Leads $lead)
    {
        return Question::forLead($lead)->get();
    }

    /**
     * @param Question $question
     * @param Collection $data
     * @return Question
     */
    public function updateStatus(Question $question, Collection $data)
    {
        $question->update(['status_id' => $data->get('status_id')]);

        return $question->refresh();
    }

    public function storeRemark(Question $question, Collection $data)
    {
        return $question->remarks()->create($data->toArray());
    }

    public function storeAttachment(Question $question, UploadedFile $file, Collection $data)
    {
        $fileUpload = $this->createFile($file, 'questions/' .$question->id);
        if ($fileUpload) {
            $question->attachments()->create([
                'description'   => $data->get('description'),
                'user_id'       => $data->get('user_id'),
                'file_path'     => $fileUpload,
            ]);
        } else {
            return null;
        }

    }

    private function createFile(UploadedFile $file, $path)
    {
        try {
            $fileOriginalName   = $file->getClientOriginalName();
            $fileExtension      = $file->getClientOriginalExtension();
            $newFileName    = \Str::of('attachment_')
                ->append(random_int(1, 100) . time())
                ->finish('.' .$fileExtension)->__toString();

            return Storage::disk('public')->putFileAs($path, $file, $newFileName);
        } catch (\Throwable $exception) {
            report($exception);
        }
        return false;
    }

    public function destroyRemark(Remark $remark)
    {
        return $remark->delete();
    }

    public function destroyAttachment(RemarkFile $file)
    {
        return $file->delete();
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

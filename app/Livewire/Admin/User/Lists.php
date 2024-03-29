<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Lists extends Component
{
    use WithPagination;

    public $userIds = [];

    public $dontDeleteThisIds = [];

    public $allUserIdsForThisPaginate = [];

    public $selectAll;

    public $paginate = 15;

    public $actionDelete = 'deleteAll';

    public function updatedPage($page)
    {
        if ($this->selectAll) {
            $this->selectField($page);

            $this->allUserIdsForThisPaginate = $this->userIds;

            $result = array_diff($this->userIds, $this->dontDeleteThisIds);

            $this->userIds = [];

            foreach ($result as $id) {
                $this->userIds[] = $id;
            }
        }
    }

    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $this->actionDelete = 'deleteAll';

            $this->selectField($this->getPage());

            $this->allUserIdsForThisPaginate = $this->userIds;
        } else {
            $this->userIds = [];

            $this->dontDeleteThisIds = [];
        }
    }

    public function updatedUserIds($value)
    {
        if ($this->selectAll) {
            $result = array_diff($this->allUserIdsForThisPaginate, $this->userIds);

            $result = collect($result)->unique();

            foreach ($result as $item) {
                if (! in_array($item, $this->dontDeleteThisIds)) {
                    $this->dontDeleteThisIds[] = $item;
                }
            }
        } else {
            $this->actionDelete = 'deleteSelectedField';
        }

        if ($value !== '__rm__') {
            if ($this->dontDeleteThisIds) {
                $result = [];
                foreach ($this->dontDeleteThisIds as $id) {
                    if (!in_array($id, $this->userIds)) {
                        $result[] = $id;
                    }
                }

                $this->dontDeleteThisIds = $result;
            }
        }
    }

    public function deleteRecord(User $user)
    {
        $user->delete();
    }
    public function deleteAll()
    {
        if ($this->dontDeleteThisIds) {
            DB::table('users')->whereNotIn('id', $this->dontDeleteThisIds)->delete();
        } else {
            DB::table('users')->delete();
        }

        $this->resetFields();
    }

    public function deleteSelectedField()
    {
        DB::table('users')->whereIn('id', $this->userIds)->delete();

        $this->resetFields();
    }

    private function resetFields()
    {
        $this->userIds = [];

        $this->dontDeleteThisIds = [];

        $this->setPage(1);

        $this->userIds = [];

        $this->selectAll = false;
    }

    private function selectField($page)
    {
        $countOffsetItems = $page * $this->paginate - $this->paginate;

        $this->userIds = User::orderBy('id')->limit($this->paginate)->offset($countOffsetItems)->pluck('id')->toArray();
    }

    #[On('users-list-updated')]
    public function render()
    {
        $users = User::orderBy('id')->paginate($this->paginate);

        return view('livewire.admin.user.lists', [
            'users' => $users,
        ]);
    }
}

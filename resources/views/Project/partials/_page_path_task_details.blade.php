<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item fs-17px"><a href="{{ route('projects.index') }}">Projects</a></li>
                    <li class="breadcrumb-item fs-17px">
                        @if(isset($project))
                            <a href="{{ route('projects.show', $project->id) }}">View Project Details</a>
                        @else
                            View Project Details
                        @endif
                    </li>
                    <li class="breadcrumb-item active fs-17px">
                        @if(isset($task))
                            <a href="{{ route('task.show', $task->id) }}">Tasks Details</a>
                        @else
                            Tasks Details
                        @endif
                    </li>
                </ul>
            </nav>
        </div><!-- .nk-block-head-content -->
        @include('partials.buttons._create_note')
    </div><!-- .nk-block-between -->
</div>
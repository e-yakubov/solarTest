<ul>
    @foreach($comments as $comment)
        <li id="comment-{{$comment->id}}">
            <div class="card">
                <div class="card-header">
                    {{$comment->name}}
                </div>
                <div class="card-body">
                    {{$comment->comment}}
                </div>
                <div class="card-footer d-flex flex-row">
                    <a href="#" class="p-2 text-success" onclick="openReplyForm({{$comment->id}})">Ответить</a>
                    <a href="#" class="p-2 text-info" onclick="openUpdateForm({{$comment->id}})">Изменить</a>
                    <a href="#" class="p-2 text-danger" onclick="delComment({{$comment->id}})">Удалить</a>
                </div>
            </div>

            @if($comment->replies)
                @include('comments', ['comments' => $comment->replies])
            @endif
        </li>
    @endforeach
</ul>

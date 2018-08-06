<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        body ul {
            list-style: none !important;
        }

        body ul li {
            margin-top: 10px;
        }
    </style>
    <meta>
</head>
<body>
<div class="container">
    <div class="row"><h1>Комментарии</h1></div>
    @if($comments)
        @include('comments', ['comments' => $comments])
    @endif

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal">
        Оставить комментарий
    </button>
</div>


<div class="modal fade" id="ModalCreate" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="javascript:void(null);" onsubmit="reply()" id="replyForm" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ответить</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                @csrf
                <input type="hidden" name="parent_id" value="" id="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Ваше имя</label>
                        <input type="text" class="form-control" id="name" placeholder="Никнейм" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="text">Комментарий</label>
                        <textarea class="form-control" id="text" rows="3" name="text"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="javascript:void(null);" onsubmit="updateComment()" id="updateForm" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ответить</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                @csrf
                <input type="hidden" name="parent_id" value="" id="upd_parent_id">
                <input type="hidden" name="parent_id" value="" id="upd_id">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Ваше имя</label>
                        <input type="text" class="form-control" id="upd_name" placeholder="Никнейм" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="text">Комментарий</label>
                        <textarea class="form-control" id="upd_text" rows="3" name="text"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
<script>
    function openReplyForm(id) {
        $("#ModalCreate").modal('show');
        $("#id").val(id);
    }

    function openUpdateForm(id) {
        $("#ModalUpdate").modal('show');

        axios.get('/api/comment/' + id)
            .then(function (response) {
                $("#upd_id").val(response.data.id);
                $("#upd_name").val(response.data.name);
                $("#upd_text").val(response.data.comment);
                $("#upd_parent_id").val(response.data.parent_id);
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    function reply() {
        let name = $('#name').val();
        let text = $('#text').val();
        let id = $("#id").val();

        axios.post('/api/comment', {
            name: name,
            comment: text,
            parent_id: id
        })
            .then(function (response) {
                $("#ModalCreate").modal('hide');
                $("#replyForm").find("input[type=text], textarea, input[type=hidden]").val("");
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    function delComment(id) {
        axios.delete('/api/comment/' + id, {})
            .then(function (response) {
                $("#comment-" + id).remove();
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    function updateComment() {
        let name = $('#upd_name').val();
        let text = $('#upd_text').val();
        let id = $("#upd_id").val();
        let parent_id = $("#upd_parent_id").val();

        axios.put('/api/comment/' + id, {
            name: name,
            comment: text,
            parent_id: parent_id
        })
            .then(function (response) {
                $("#ModalUpdate").modal('hide');
                $("#updateForm").find("input[type=text], textarea, input[type=hidden]").val("");
            })
            .catch(function (error) {
                console.log(error);
            });
    }
</script>
</body>
</html>

@extends('layouts.app')

@section('content')
    @if (Auth::id() == $user->id)
        <div class="mt-4">
            <form method="POST" action="{{ route('transfers.store') }}">
                @csrf

                <div class="form-control mt-4">
                    振込先口座番号(id)<textarea rows="2" name="to_user_id" class="input input-bordered w-full">{!! Auth::id() !!}以外を入力してください</textarea>
                </div>
                <div class="form-control mt-4">
                    金額<textarea rows="2" name="price" class="input input-bordered w-full"></textarea>
                </div>
                <div class="form-control mt-4">
                    内容<textarea rows="2" name="content" class="input input-bordered w-full"></textarea>
                </div> 
            
                <button type="submit" class="btn btn-primary btn-block normal-case">確定</button>
            </form>
        </div>
    @endif
@endsection
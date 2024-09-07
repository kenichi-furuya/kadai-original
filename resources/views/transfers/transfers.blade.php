<div class="mt-4">
    @if (isset($transfers))
        {{-- 残高 --}}
        <h2>入金:{!! nl2br(e($value1)) !!}</h2>
        <h2>他者から振込:{!! nl2br(e($value2)) !!}</h2>
        <h2>送金:{!! nl2br(e($value3)) !!}</h2>
        <h2>合計:{!! nl2br(e($total)) !!}</h2> {{--   --}}
        
        {{-- 履歴 --}}
        <h2>■入出金履歴</h2>
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th class="text-center normal-case">from</th>
                    <th class="text-center normal-case">to</th>
                    <th class="text-center normal-case">入出金日時</th>
                    <th class="text-center normal-case">内容</th>
                    <th class="text-center normal-case">金額</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($transfers as $transfer)
                <tr>
                    <td class="text-center">{!! nl2br(e($transfer->user_id)) !!}</th>
                    <td class="text-center">{!! nl2br(e($transfer->to_user_id)) !!}</td>
                    <td class="text-center">{!! nl2br(e($transfer->created_at)) !!}</td>
                    <td class="text-center">{!! nl2br(e($transfer->content)) !!}</td>
                    <td class="text-center">{!! nl2br(e($transfer->price)) !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- ページネーションのリンク --}}
        {{ $transfers->links() }}
    @endif
</div>
<div class="card border border-base-300">
    <div class="sm:grid sm:grid-cols-2 sm:gap-10">
        <aside class="mt-4">
        <h2>名前　{{ $user->name }}</h2>
        <h2>口座番号 {{ $user->id }}</h2>
        </aside>
    </div>

    <figure>
        {{-- ユーザーのメールアドレスをもとにGravatarを取得して表示 --}}
        <img src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
    </figure>
</div>

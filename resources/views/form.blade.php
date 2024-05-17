<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>データベース登録用フォーム</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    @if (session('success'))
    <div class="alert alert-info w-full p-4 mb-4 bg-gray-200 text-md font-bold text-center text-red-400 rounded-md">
        {{ session('success') }}
    </div>
    @endif

    <div class="w-3/5 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-center text-2xl font-bold mb-6">データベース登録用フォーム</h2>
        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf
            <div class="mb-4 flex items-center">
                <label for="major_category" class="block text-gray-700 mr-4 w-1/3">大カテゴリー</label>
                <select name="major_category_id" id="major_category" class="w-full p-2 border rounded">
                    <option value="">選択してください</option>
                    @foreach ($major_categories as $category)
                    <option value="{{ $category->id }}">{{ $category->major_category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4 flex items-center">
                <label for="new_major_category" class="block text-gray-700 mr-4 w-1/3">新しい大カテゴリーを追加する</label>
                <input type="text" name="new_major_category" id="new_major_category" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4 flex items-center">
                <label for="minor_category" class="block text-gray-700 mr-4 w-1/3">小カテゴリー</label>
                <input type="text" name="minor_category_name" id="minor_category" list="minor_categories"
                    class="w-full p-2 border rounded">
                <datalist id="minor_categories">
                    @foreach ($minor_categories as $category)
                    <option value="{{ $category->minor_category_name }}"></option>
                    @endforeach
                </datalist>
            </div>
            <div class="mb-4 flex items-center">
                <label for="quantity" class="block text-gray-700 mr-4 w-1/3">数量</label>
                <input type="number" name="quantity" id="quantity" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4 flex items-center">
                <label for="amount" class="block text-gray-700 mr-4 w-1/3">金額</label>
                <input type="number" name="amount" id="amount" class="w-full p-2 border rounded">
            </div>
            <button type="submit"
                class="block bg-blue-500 text-white p-2 rounded hover:bg-blue-600 w-20 mx-auto my-0">登録</button>
        </form>
    </div>
</body>

</html>
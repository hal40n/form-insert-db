<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データベース登録用フォーム</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6">データベース登録用フォーム</h2>
        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="major_category" class="block text-gray-700">大カテゴリー</label>
                <select name="major_category_id" id="major_category" class="w-full p-2 border rounded">
                    <option value="">選択してください</option>
                    @foreach ($major_categories as $category)
                    <option value="{{ $category->id }}">{{ $category->major_category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <labe for="new_major_category" class="block text-gray-700">新しい大カテゴリーを追加する</label>
                <input type="text" name="new_major_category" id="new_major_category" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="minor_category" class="block text-gray-700">小カテゴリー</label>
                <input type="text" name="minor_category_name" id="minor_category" list="minor_categories" class="w-full p-2 border rounded">
                <datalist id="minor_categories">
                    @foreach ($minor_categories as $category)
                        <option value="{{ $category->minor_category_name }}"></option>
                    @endforeach
                </datalist>
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-gray-700">数量</label>
                <input type="number" name="quantity" id="quantity" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-gray-700">金額</label>
                <input type="number" name="amount" id="amount" class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">登録</button>
        </form>
    </div>
    @vite('resources/js/app.js')
</body>

</html>
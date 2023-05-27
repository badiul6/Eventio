<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-8">
        <form>
            @csrf
            <h1 class="text-2xl font-bold mb-4">Events by Society</h1>
            <table class="w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-900">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left font-medium text-gray-900">
                            Niche
                        </th>
                        <th class="px-6 py-3 text-left font-medium text-gray-900">
                            Location
                        </th>
                        <th class="px-6 py-3 text-left font-medium text-gray-900">
                            Capacity
                        </th>
                        <th class="px-6 py-3 text-left font-medium text-gray-900">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($events as $event)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{$event->name}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{$event->niche}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{$event->location}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{$event->capacity}}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="{{ route('event.showedit', $event->id) }}" class="text-indigo-600 hover:text-indigo-900 pr-5">Edit</a>
                            <a href="{{ route('event.delete', $event->id) }}" class="text-red-600 hover:text-red-900">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</body>

</html>

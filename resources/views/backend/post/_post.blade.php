@foreach($posts as $i)
    <tr class="odd gradeX">
        <td> {{ $i->id }}</td>
        <td>
            <p class="font-red-mint">{{ $i->name }}</p>
            @if($i->description)
                <blockquote><small>{{ $i->description }}</small></blockquote>
            @endif
        </td>
        <td class="data-middle">{{ $i->created_at }}</td>
        <td class="data-middle">
            @if($i->status === 1)
                <span class="badge badge-info badge-roundless"> Approved </span>
            @else
                <span class="badge badge-default badge-roundless"> No </span>
            @endif
        </td>
        <td class="data-middle">
            <form action="{{ route('post.destroy', $i->id) }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <a href="{{ route('post.edit', ['post' => $i->id]) }}"
                   class="btn red btn-sm">Update</a>
                <button type="button" class="btn red btn-sm btn-delete">Delete
                </button>
            </form>
        </td>
    </tr>
@endforeach
@foreach($games as $i)
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
            @foreach($groups as $j)
                <p class="margin-bottom-10">
                    @if(in_array($j->id, joinGroup($i->groups)))
                        <a href="javascript:;" class="btn btn-xs blue check-group">
                            <i class="fa fa-check"></i>
                            {{ $j->value }}
                        </a>
                        <a class="btn btn-xs red remove-group" data-post="{{ $i->id }}"
                           data-group-name="{{ $j->value }}"
                           data-group-id="{{ $j->id }}">
                            <i class="fa fa-times"></i>
                        </a>
                    @else
                        <button class="btn btn-xs grey-cascade set-groups" data-post="{{ $i->id }}"
                                data-group-name="{{ $j->value }}"
                                data-group-id="{{ $j->id }}"> Set to "{{ $j->value }}"</button>
                    @endif
                </p>
            @endforeach

        </td>
        <td class="data-middle">
            @if($i->status === 1)
                <span class="badge badge-info badge-roundless"> Approved </span>
            @else
                <span class="badge badge-default badge-roundless"> No </span>
            @endif
        </td>
        <td class="data-middle">
            <form action="{{ route('game.destroy', $i->id) }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <a href="{{ route('game.edit', ['game' => $i->id]) }}"
                   class="btn red btn-sm">Update</a>
                <button type="button" class="btn red btn-sm btn-delete">Delete
                </button>
            </form>
        </td>
    </tr>
@endforeach
@forelse ($masterlists as $masterlist)
    <tr class="text-center">
        <td>{{ $masterlist->id_num }}</td>
        <td>{{ $masterlist->sn_num }}</td>
        <td>{{ $masterlist->capacity }}
            @isset($result->masterList->unit->symbol)
                {{ $result->masterList->unit->symbol }}
            @else
                <span class="text-danger">N/A</span>
            @endisset
        </td>
        <td>{{ $masterlist->accuracy }}
            @isset($result->masterList->unit->symbol)
                {{ $result->masterList->unit->symbol }}
            @else
                <span class="text-danger">N/A</span>
            @endisset
        </td>
        <td>{{ $masterlist->brand }}</td>
        <td>{{ $masterlist->calibration_type }}</td>
        <td>{{ $masterlist->first_used }}</td>
        <td>{{ $masterlist->rank }}</td>
        <td>{{ $masterlist->calibration_freq }}</td>
        <td>{{ $masterlist->acceptance_criteria }}</td>
        <td>{{ $masterlist->pic }}</td>
        <td>
            <button class="btn btn-primary btn-sm btn-edit-masterlist" data-id="{{ $masterlist->id }}"
                data-id-num="{{ $masterlist->id_num }}" data-sn-num="{{ $masterlist->sn_num }}">
                Edit
            </button>
            <button class="btn btn-danger btn-sm btn-delete-masterlist" data-id="{{ $masterlist->id }}"
                data-id-num="{{ $masterlist->id_num }}" data-sn-num="{{ $masterlist->sn_num }}" data-bs-toggle="modal"
                data-bs-target="#deleteMasterListModal">
                Delete
            </button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="15" class="text-center">No data available</td>
    </tr>
@endforelse

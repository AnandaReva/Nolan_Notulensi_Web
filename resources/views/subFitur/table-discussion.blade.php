@if ($currentUrl == 'edit')
    <script>
        var idxFromBlade = @json($idx); // Convert PHP variable $idx to a JavaScript variable
    </script>
@endif

<table class="table table-bordered align-middle text-center w-100" id="discussion-container">
    <thead>
        <tr>
            <th>No</th>
            <th class="col-4">Discussion</th>
            <th class="col-3">Follow Up Actions</th>
            <th class="col-2">Due Date</th>
            <th class="col-2">PIC</th>
        </tr>
    </thead>
    <tbody>
        @if ($currentUrl == 'edit')
            {{-- edit page --}}
            @foreach ($meeting->contents as $index => $content)
                <tr data-discussion-index="{{ $index }}">
                    <td>{{ $index + 1 }}</td>
                    <td class="text-start col-4">
                        <textarea id="discussion" cols="30" rows="4" class="form-control"
                            name="discussion[{{ $index }}][content]">
                            {{ $content->discussion }}
                        </textarea>
                    </td>
                    <td class="text-start col-4" name="item[{{ $index }}][]" id="action-col-{{ $index }}">
                        @foreach ($content->actions as $idx => $action)
                            <input class="w-100 mb-3" id="actions" type="text"
                                name="discussion[{{ $index }}][actions][{{ $idx }}][item]"
                                value="{{ $action->item }}">
                        @endforeach
                    </td>
                    <td class="col-1" name="due[0][]" id="due-date-col-{{ $index }}">
                        @foreach ($content->actions as $idx => $action)
                            <input class="mb-3" id="dueDate" type="date"
                                name="discussion[{{ $index }}][actions][{{ $idx }}][due]"
                                value="{{ $action->due }}">
                        @endforeach
                    </td>
                    <td class="col-2">
                        <div id="pic-{{ $index }}">
                            @foreach ($content->actions as $idx => $action)
                                <select id="pic_0"
                                    name="discussion[{{ $index }}][actions][{{ $idx }}][pic]">
                                    <option value="0">Select PIC</option>
                                    @foreach ($peserta_tersedia as $option)
                                        <option value="{{ $option->id }}"
                                            {{ $action->pic == $option->id ? 'selected' : '' }}>
                                            {{ $option->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endforeach
                        </div>
                        <button class="border-0 bg-transparent" id="add-action"
                            onclick="addAction(event, {{ $index }})"><i
                                class="fa-solid fa-plus border border-black rounded-circle p-1"></i></button>
                    </td>
                </tr>
            @endforeach
        @elseif ($currentUrl == 'add')
            {{-- create note --}}
            <tr>
                <td>1</td>
                <td class="text-start col-4">
                    <textarea name="discussion[]" id="discussion" cols="30" rows="4" class="form-control"></textarea>
                </td>
                <td class="text-start col-4" name="item[0][]" id="action-col-0"></td>
                <td class="col-1" name="due[0][]" id="due-date-col-0"></td>
                <td class="col-2">
                    <div id="pic-0"></div>
                    <button class="border-0 bg-transparent" id="add-action" onclick="addAction(event, 0)"><i
                            class="fa-solid fa-plus border border-black rounded-circle p-1"></i></button>
                </td>
            </tr>
        @else
            {{-- view page --}}
            @foreach ($meeting->contents as $content)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-start col-4">
                        <p>
                            {{ $content->discussion }}
                        </p>
                    </td>
                    <td class="text-start col-4">
                        <ul class="list-unstyled">
                            @foreach ($content->actions as $action)
                                <li>
                                    @if ($action->item)
                                        {{ $action->item }}
                                    @else
                                        (No Item)
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="col-1">
                        <ul class="list-unstyled">
                            @foreach ($content->actions as $action)
                                <li>
                                    @if ($action->due)
                                        {{ $action->due }}
                                    @else
                                        (No Due)
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="col-2">
                        <ul class="list-unstyled">
                            @foreach ($content->actions as $action)
                                <li>
                                    @if ($action->picParticipant)
                                        {{ $action->picParticipant->name }}
                                    @else
                                        -
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    @if ($currentUrl == 'add' || $currentUrl == 'edit')
        <script>
            var pesertaTersedia = @json($peserta_tersedia);
        </script>
    @endif
</table>

@unless ($currentUrl == 'view')
    <button onclick="addRow(event)" class="btn btn-outline-dark p-2" id="addDiscussion"><i
            class="fa-solid fa-plus border border-black rounded-circle p-1 me-2"></i>Add Item Discussion</button>
@endunless

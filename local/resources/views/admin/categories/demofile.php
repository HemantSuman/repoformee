  @foreach ($result->classified_attribute as $val)
                            <div>
                                <input checked onclick="return false" type="checkbox" value="{{ $val->id }}" name="attr_ids[]">
                                {{ $val->name }}
                            </div>

                            @endforeach
 
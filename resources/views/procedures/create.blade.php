
<form action="{{ route('procedures.store') }}" method="POST">
        @csrf
        <div id="dynamicInput">
            <div class="input-group">
                <input type="text" name="data[]" placeholder="Nhập dữ liệu" required>
                <button type="button" id="addInput">Thêm input</button>
            </div>
        </div>
        <button type="submit">Lưu</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#addInput').click(function() {
                $('#dynamicInput').append('<div class="input-group"><input type="text" name="data[]" placeholder="Nhập dữ liệu" required><button type="button" class="removeInput">Xóa</button></div>');
            });

            $(document).on('click', '.removeInput', function() {
                $(this).parent().remove();
            });
        });
    </script>
    
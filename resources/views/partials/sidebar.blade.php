    <!-- Sidebar -->
    <div class="sidebar">
        <ul style="margin-top: 10px;">
            <li>
                <a href="#">
                    <span class="icon">
                        <img src="{{ asset('assets/icon/window.png') }}" alt="">
                    </span>
                    <span class="title">MENU</span>
                </a>
            </li>
            <li style = "display: flex;">
                <a href="!#">
                    <span class="icon">
                    <img src="{{ asset('assets/icon/database.png') }}" alt="">
                    </span>
                    <div class="dropdown">
                        <span class="title dropbtn ">DATABASE</span>
                            <div class="dropdown-content">
                                <a href="{{ route('categories.index') }}">Category</a>
                                <a href="{{ route('products.index') }}">Product</a>
                                <a href="{{ route('lots.index') }}">Lot</a>
                                <a href="{{ route('departments.index') }}">Department</a>
                                <a href="{{ route('processes.index') }}">Process</a>
                                <a href="{{ route('procedures.index') }}">Procedure</a>
                                
                            </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon">
                    <img src="{{ asset('assets/icon/setting.png') }}" alt="">
                    </span>
                    <span class="title">SETTINGS</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon">
                    <img src="{{ asset('assets/icon/question-mark.png') }}" alt="">
                    </span>
                    <span class="title">HELP</span>
                </a>
            </li>
            
        </ul>       
    </div>
  
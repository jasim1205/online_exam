 <ul>
                        {{-- <li class="menu-title">
                            <span>Main</span>
                        </li> --}}
                        <li>
                            <a href="{{route('dashboard')}}"><i class="la la-dashboard"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
                        </li>
                        <li class="submenu">
                            <a href=""><i class="la la-cube"></i> <span> Account</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="{{route('role.index')}}">Role</a></li>
                                <li><a href="{{route('user.index')}}">Users</a></li>
                                <li><a href="{{route('student')}}">Student List</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href=""><i class="la la-cube"></i> <span> ACL</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="{{route('classlist.index')}}">ClassList</a></li>
                                <li><a href="{{route('subject.index')}}">Subject</a></li>
                                <li><a href="{{route('examtype.index')}}">Exam-Type</a></li>
                                <li><a href="{{route('exam.index')}}">Exam</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('logOut')}}"><i class="la la-lock"></i> <span>Logout</span></a>
                        </li>
                    </ul>
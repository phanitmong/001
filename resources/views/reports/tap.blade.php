<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active ">
          <a class="nav-link " href="{{route('report.index')}}" id="overview">ទូទៅ<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{route('report.stock_in')}}" id="stock_in">ស្តុកចូល<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{route('report.stock_out')}}" id="stock_out">ស្តុកចេញ<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">វិក្កយបត្រ<span class="sr-only" id="invoice">(current)</span></a>
          </li>

      </ul>

      <form action=""  class="form-inline my-2 my-lg-0">
        <select name="filter" class="form-control" id="" style="font-size: 12px" onclick="submit()">
            <option value="alltime" {{Session::get('filter')==0?'selected':''}}>ទាំងអស់</option>
            <option value="1" {{Session::get('filter')==1?'selected':''}}>ថ្ងៃនេះ</option>
            <option value="7" {{Session::get('filter')==7?'selected':''}}>7 ថ្ងៃចុងក្រោយ</option>
            <option value="30" {{Session::get('filter')==30?'selected':''}}>30 ថ្ងៃចុងក្រោយ</option>
            @for ($i = 2022; $i <= date('Y'); $i++)
            <option value="{{$i}}" {{Session::get('filter')==$i?'selected':''}}>{{$i}}</option>
            @endfor
        </select>
    </form>
    </div>
  </nav>

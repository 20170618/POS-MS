<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LiveSearch extends Controller
{
    function index()
    {
     return view('admin.searchproducts');
    }

     
    
    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('product')
         ->where('ProductName', 'like', '%'.$query.'%')
         ->orWhere('Category','like','%'.$query.'%')
         ->orderBy('ProductID', 'desc')
         ->get();

      }
      else
      {
       $data = DB::table('product')
         ->orderBy('ProductID', 'desc')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
         if ($row->Category == "E-Load Regular") {
          $output .= '
          <tr>
            <td>'.$row->ProductName.'</td>
            <td> </td>
            <td>'.$row->Stock.'</td>
            <td>'.$row->Category.'</td>
            <td></td>

          </tr>';
         }else{
          $output .= '
            <tr>
              <td>'.$row->ProductName.'</td>
              <td>&#8369; '.number_format($row->Price, 2).'</td>
              <td>'.$row->Stock.'</td>
              <td>'.$row->Category.'</td>
              <td><button class="btn btn-info editProduct" value="'.$row->ProductID.'" style="margin-right:2%"><i class="fas fa-pen"></i></button><button class="btn btn-danger deleteProduct" value="'.$row->ProductID.'"><i class="fas fa-trash"></i></button></td>

            </tr>';
         }
        
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }

    // ------
    
    function action2(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('product')
         ->where('ProductName', 'like', '%'.$query.'%')
         ->orWhere('Category','like','%'.$query.'%')
         ->orderBy('ProductID', 'desc')
         ->get();

      }
      else
      {
       $data = DB::table('product')
         ->orderBy('ProductID', 'desc')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td>'.$row->ProductName.'</td>
         <td>&#8369; '.number_format($row->Price, 2).'</td>
         <td>'.$row->Stock.'</td>
         <td>'.$row->Category.'</td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
}

<?php

namespace App\Http\Services\Menu;

use App\Models\ChildrenMenu;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }
    public function show()
    {
        return Menu::select('name', 'id')
            ->where('parent_id', 0)
            -> orderbyDesc('id')
            ->get();
    }
    public function getAll()
    {
        return Menu::orderby('id')->paginate(20); // phân trang
    }

    public function create($request)
    {
        try {
            if ($request->has('parent_id') && $request->parent_id != 0) {
                ChildrenMenu::create([
                    'name' => (string)$request->input('name'),
                    'menus_id' => (string)$request->input('parent_id'),
                    'active' => (string)$request->input('active'),
                ]);
            } else {
                Menu::create([
                    'name' => (string)$request->input('name'),
                    'parent_id' => (string)$request->input('parent_id'),
                    'description' => (string)$request->input('description'),
                    'content' => (string)$request->input('content'),
                    'active' => (string)$request->input('active')
                ]);
            }

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    public function update($request, $menu)
    {
        //        $menu->fill($request->input())->save();
        if ($request->input('parent_id') != $menu->id){
            $menu->parent_id= (int) $request->input('parent_id');
        }
        $menu->name = (string) $request->input('name');
        $menu->description= (string) $request->input('description');
        $menu->content= (string) $request->input('content');
        $menu->active= (string) $request->input('active');
        $menu->save();

        Session::flash('success', 'Cập nhật thành công Danh Mục');
        return true;
    }
    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $menu = Menu::where('id', $id)->first();

        if ($menu){
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    public function getId($id)
    {
        return Menu::where('id', $id)->where('active',1)->firstOrFail();
    }
    public function getProduct($menu, $request)
    {
        $query = $menu->products()->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active',1);

        if($request->input('price_sale')){
            $query->orderBy('price_sale', $request->input('price_sale'));
        }
            return $query
                ->orderByDesc('id')
                ->paginate(12)
                ->withQueryString();
    }

}

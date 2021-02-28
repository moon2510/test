<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\ImageSlider;

class SliderController extends Controller
{
	public function index(){
		$sliders = ImageSlider::orderBy('id', 'ASC')->paginate(50);
		return view('admin.slider.index', compact(['sliders']));
	}

    public function create(){
    	return view('admin.slider.create');
    }

    public function store(SliderRequest $request){
    	$data = $request->except('_token');
        $data['category_id'] = $request->category;
        if($request->hasFile('img')){
            $file = $request->file('img');
            $filename = '/images/sliders/'.md5(time()).'.jpg';
            $file->move(public_path('/images/sliders/'), $filename);
            $data['path'] = $filename;
        }
        if($slider = ImageSlider::create($data)){
    		return redirect()->route('Slider.Edit', $slider->id)->with(['class'=>'success','message'=>'Thêm slider thành công.']);
    	}
        else{
            return redirect()->back()->with(['class'=>'danger','message'=>'Lỗi hệ thống, thử lại sau.']);
        }
    }

    public function edit($id){
    	if($slider = ImageSlider::find($id)){
    		return view('admin.slider.edit', compact(['slider']));
    	}
    	else{
    		return redirect()->route('Slider.Create');
    	}
    }

    public function update(UpdateSliderRequest $request, $id){
    	$data = $request->except('_token', 'path');
    	if($slider = ImageSlider::find($id)){
    		if($slider->update($data)){
    			return redirect()->route('Slider.List')->with(['class' => 'success', 'message' => 'Thay đổi thành công']);
    		}
    		else{
    			return redirect()->back()->with(['class' => 'success', 'lỗi hệ thống, thử lại sau']);
    		}
    	}
    	else{
    		return redirect()->route('Slider.List');
    	}
    }

    public function search(request $request){
    	$sliders = ImageSlider::where('id', 'LIKE', "%$request->key%")->orWhere('title', 'LIKE', "%$request->key%")->orWhere('subtitle', 'LIKE', "%$request->key%")->orWhere('link', 'LIKE', "%$request->key%")->orWhere('button_title', 'LIKE', "%$request->key%")->orderBy('id', 'ASC')->paginate(50);
    	return view('admin.slider.index', compact(['sliders']));
    }

    public function destroy(request $request){
    	if($slider = ImageSlider::find($request->id)){
    		if($slider->delete()){
				return response()->json(['error' => 0, 'message' => 'Đã xóa thành công']);
    		}
    		else{
    			return response()->json(['error' => 1, 'message' => 'Lỗi hệ thống, thử lại sau']);
    		}
    	}
    	return response()->json(['error' => 1, 'message' => 'Không tìm thấy Slider']);
    }
}

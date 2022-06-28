@extends('admin.layouts.master')
@section('content')
	<div class="content-wrapper">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		@if(session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		@endif
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Media</h1>
					</div>
					<!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
							<li class="breadcrumb-item active">Media</li>
						</ol>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div>
		</div>
		<section class="content">
			<div class="container-fluid">
				{{ Form::open(['method' => 'POST', 'route' => 'media.store', 'enctype' => 'multipart/form-data']) }}
				<div class="row">
					<div class="col-md-9">
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Add Media</h3>
							</div>
							<div class="card-body">
								<section>
									<div class="container">
									{{ Form::hidden('id', !empty($fdata->id) ? $fdata->id : null) }}
									<!-- part-1 start  -->
										<div class="row first_part-1 ">
											<div class="col-12">
											</div>
											<div class="col-6">
												<div class="form-group">
													{{ Form::label('media_type', ' Media Type') }}
													{{ Form::select('media_type', getMediaTypes(), !empty($fdata->media_type) ? $fdata->media_type : null, ['class' => $errors->has('media_type') ? 'form-control myselect2 is-invalid' : 'form-control','placeholder' => 'Select Media Type']) }}
													@error('media_type')
													<span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
													@enderror
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													{{ Form::label('parent', 'Parent') }}
													{{ Form::select('parent_id', getMediaArr(), $fdata && $fdata->media ? $fdata->media->id : null, ['class' => $errors->has('parent_id') ? 'form-control myselect2  is-invalid' : 'form-control myselect2','placeholder' => 'Select Parent']) }}
													@error('parent_id')
													<span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
													@enderror
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													{{ Form::label('name', 'Name') }}
													{{ Form::text('name', !empty($fdata->name) ? $fdata->name : null, ['id' => 'name', 'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Name']) }}
													@error('name')
													<span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
													@enderror
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													{{ Form::label('Slug', 'Slug') }}
													{{ Form::text('slug', !empty($fdata->slug) ? $fdata->slug : null, ['id' => 'slug', 'class' => $errors->has('slug') ? 'form-control is-invalid' : 'form-control','placeholder' => 'Slug']) }}
													@error('slug')
													<span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
													@enderror
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													{{ Form::label('Categories', 'Categories') }}
													{{ Form::select('category_id[]', getCategoryArr(), $fdata && $fdata->categories ? $fdata->categories->pluck('id')->toArray() : null, ['class' => $errors->has('category_id') ? 'form-control myselect2  is-invalid' : 'form-control myselect2','multiple'=>'multiple']) }}
													@error('category_id')
													<span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
													@enderror
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													{{ Form::label('release_date', 'Release Date') }}
													{{ Form::date('release_date', !empty($fdata->release_date) ? $fdata->release_date : null, ['id' => 'release_date', 'class' => $errors->has('release_date') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'release date']) }}
													@error('release_date')
													<span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
													@enderror
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
													{{ Form::label('tag', 'Tags') }}
													{{ Form::select('tag_id[]', getTagArr(), $fdata && $fdata->tags ? $fdata->tags->pluck('id')->toArray() : null, ['class' => $errors->has('tag_id') ? 'form-control myselect2  is-invalid' : 'form-control myselect2', 'multiple'=>'multiple']) }}
													@error('tag_id')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
													{{ Form::label('related_media', 'Related Media') }}
													{{ Form::select('related_media[]', getMediaArr(), $fdata->relatedMedia ? $fdata->relatedMedia->pluck('id')->toArray() : null, ['class' => $errors->has('related_media') ? 'form-control myselect2  is-invalid' : 'form-control myselect2', 'multiple'=>'multiple']) }}
													@error('related_media')
													<span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
													@enderror
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-8">
												<div class="form-group">
													{{ Form::label('description', 'Description') }}
													{{ Form::textarea('description', !empty($fdata->description) ? $fdata->description : null, ['rows' => 16, 'placeholder' => 'Description..', 'class' => 'htmltexteditor form-control ' . ($errors->has('description') ? ' is-invalid' : '')]) }}
													@error('description')
													<span class="invalid-feedback" role="alert">
			                                            <strong>{{ $message }}</strong>
			                                        </span>
													@enderror
												</div>
											</div>
											<div class="col-4">

												<div class="form-group">
													{{ Form::label('run_time', 'Runtime') }}
													{{ Form::text('run_time', !empty($fdata->run_time) ? $fdata->run_time : null, ['id' => 'name', 'class' => $errors->has('run_time') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Runtime']) }}
													@error('run_time')
													<span class="invalid-feedback" role="alert">
	                                                    <strong>{{ $message }}</strong>
	                                                </span>
													@enderror
												</div>

												<div class="form-group">
													{{ Form::label('link', 'Youtube/Trailer Link') }}
													{{ Form::text('link', !empty($fdata->link) ? $fdata->link : null, ['id' => 'link', 'class' => $errors->has('link') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Youtube/Trailer Link']) }}
													@error('link')
													<span class="invalid-feedback" role="alert">
	                                                    <strong>{{ $message }}</strong>
	                                                </span>
													@enderror
												</div>

												<div class="form-group">
													{{ Form::label('cinebazurl', 'Cinebaz Link') }}
													{{ Form::text('cinebazurl', !empty($fdata->cinebazurl) ? $fdata->cinebazurl : null, ['id' => 'cinebazurl', 'class' => $errors->has('cinebazurl') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Cinebaz Link']) }}
													@error('cinebazurl')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
	                                                </span>
													@enderror
												</div>
												<div class="form-group">
													{{ Form::label('box_office', 'Box-Office') }}
													{{ Form::text('box_office', !empty($fdata->box_office) ? $fdata->box_office : null, ['id' => 'box_office', 'class' => $errors->has('box_office') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Box Office']) }}
													@error('box_office')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
												<div class="form-group">
													{{ Form::label('budget', 'Budget') }}
													{{ Form::text('budget', !empty($fdata->budget) ? $fdata->budget : null, ['id' => 'budget', 'class' => $errors->has('budget') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Budget']) }}
													@error('budget')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-6">
											</div>
											<div class="col-6">
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												<div class="form-group">
													{{ Form::label('Country', 'Country Of Origin') }}
													{{ Form::select('country_origin', getCountryorigin(), !empty($fdata->country_origin) ? $fdata->country_origin : null, ['class' => $errors->has('country_origin') ? 'form-control myselect2 is-invalid' : 'form-control','placeholder' => 'Select a Country']) }}
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													{{ Form::label('language', 'Language') }}
													{{ Form::select('language', getlanguage(), $fdata->language,['class' =>  'form-control myselect2', 'placeholder' => 'Select a Language']) }}
												</div>
											</div>
										</div>
										<div class="row film_part">
											<div class="col-lg-6">
												<div class="form-group">
													{{ Form::label('filming_location', 'Filming Locations') }}
													{{ Form::select('filming_location', getCountries(), $fdata->filming_location,['class' =>  'form-control myselect2', 'multiple' => 'multiple']) }}
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													{{ Form::label('sound_mix', 'Sound Mix') }}
													{{ Form::text('sound_mix', !empty($fdata->sound_mix) ? $fdata->sound_mix : null, ['id' => 'sound_mix', 'class' => $errors->has('sound_mix') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Sound Mix']) }}
												</div>
											</div>
										</div>
										<!-- part-7 start -->
										<div class="row part-7-cs">
											<div class="col-12">
												<div class="card">
													<div class="card-header">
														<h5>
															Director
															<button @click='toggle.directors = !toggle.directors' type="button" class="btn btn-primary" style="float:right;">
																<span v-if="!toggle.directors">Show</span>
																<span v-else>Hide</span>
															</button>
														</h5>
													</div>
													<div class="card-body" id="part_7" v-if="toggle.directors">
														{{-- @{{directors}} --}}
														<div class="row control-group" v-for="(input, i) in directors">
															<div class="form-group col-lg-8">
																{{ Form::label('name', 'Name') }}
																{{-- @{{i}} --}}
																{{-- {{ Form::select(null, $people, $fdata && $fdata->people ? $fdata->people->pluck('name','id')->toArray() : null, ['class' => $errors->has('entity_id') ? 'form-control   is-invalid' : 'form-control ', 'placeholder' =>'Select A Name']) }} --}}
																<div class="input-group mb-3">
																	{{ Form::select(null, $people, $fdata && $fdata->people ? $fdata->people->pluck('id')->toArray() : null, ['class' => $errors->has('entity_id') ? 'form-control   is-invalid' : 'form-control ', 'placeholder' =>'Select A Name', 'v-model' => 'input.entity_id', ':name' => "'directors['+ input.id +'][entity_id]'",'required' => true]) }}
																	<div class="input-group-append">
																		<button @click="addInput(directors, input.id, 2)" class="btn btn-primary" type="button" v-if="i < 1">+Add</button>
																		<button @click="remove(directors, input.id)" class="btn btn-danger" type="button" v-else>-Remove </button>
																		{{-- @{{input.id}} --}}
																	</div>
																</div>
																<input :name="'directors['+ input.id +'][role_id]'" type="hidden" v-model="input.role_id" :key="i+'role'"/>
																<input :name="'directors['+ input.id +'][character_name]'" type="hidden" v-model="input.character_name" :key="i+'character'"/>
																<input :name="'directors['+ input.id +'][is_new]'" type="hidden" v-model="input.is_new" :key="i+'is_new'" v-if="input.is_new"/>
																@error('entity_id')
																<span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
																@enderror
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row part-7-cs">
											<div class="col-12">
												<div class="card">
													<div class="card-header">
														<h5>
															Cast
															<button @click='toggle.casts = !toggle.casts' type="button" class="btn btn-primary" style="float:right;">
																<span v-if="!toggle.casts">Show</span>
																<span v-else="">Hide</span>
															</button>
														</h5>
													</div>
													<div class="card-body" id="part_7"  v-if='toggle.casts'>
														{{-- @{{directors}} --}}
														<div class="row control-group" v-for="(input, i) in casts">
															<div class="form-group col-12">
																<div class="row">
																	<div class="col-4">
																		<div class="form-group">
																			<label>Character Name</label>
																			<input class="form-control" :name="'casts['+ input.id +'][character_name]'" type="text" v-model="input.character_name" :key="i+'character'"/>
																		</div>
																		<input :name="'casts['+ input.id +'][role_id]'" type="hidden" v-model="input.role_id" :key="i+'role'"/>
																		<input :name="'casts['+ input.id +'][is_new]'" type="hidden" v-model="input.is_new" :key="i+'is_new'" v-if="input.is_new"/>
																	</div>
																	<div class="col-8">
																		<label :for="'casts['+ input.id +'][entity_id]'">Name</label>
																		<div class="input-group mb-3">
																			{{ Form::select(null, $people, $fdata && $fdata->people ? $fdata->people->pluck('name','id')->toArray() : null, ['class' => $errors->has('entity_id') ? 'form-control   is-invalid' : 'form-control ', 'placeholder' =>'Select A Name', 'v-model' => 'input.entity_id', ':name' => "'casts['+ input.id +'][entity_id]'"]) }}
																			<div class="input-group-append">
																				<button @click="addInput(casts, input.id, 1)" class="btn btn-primary" type="button" v-if="i < 1">+Add</button>
																				<button @click="remove(casts, input.id)" class="btn btn-danger" type="button" v-else>-Remove </button>
																				{{-- @{{input.id}} --}}
																			</div>
																		</div>
																	</div>
																</div>
																@error('entity_id')
																<span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
																@enderror
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- part-6 end  -->
										<div class="row part-7-cs">
											<div class="col-12">
												<div class="card">
													<div class="card-header">
														<h5>
															Producer
															<button @click='toggle.producers = !toggle.producers' type="button" class="btn btn-primary" style="float:right;">
																<span v-if="!toggle.producers">Show</span>
																<span v-else>Hide</span>
															</button>
														</h5>
													</div>
													<div class="card-body" id="part_7"  v-if='toggle.producers'>
														<div class="row control-group" v-for="(input, i) in producers">
															<div class="form-group col-lg-8">
																{{ Form::label('name', 'Name') }}
																<div class="input-group mb-3">
																	{{ Form::select(null, $people, $fdata && $fdata->people ? $fdata->people->pluck('name','id')->toArray() : null, ['class' => $errors->has('entity_id') ? 'form-control   is-invalid' : 'form-control ', 'placeholder' =>'Select A Name', 'v-model' => 'input.entity_id', ':name' => "'producers['+ input.id +'][entity_id]'"]) }}
																	<div class="input-group-append">
																		<button @click="addInput(producers, input.id, 4)" class="btn btn-primary" type="button" v-if="i < 1">+Add</button>
																		<button @click="remove(producers, input.id)" class="btn btn-danger" type="button" v-else>-Remove </button>
																	</div>
																</div>
																<input :name="'producers['+ input.id +'][role_id]'" type="hidden" v-model="input.role_id" :key="i+'role'"/>
																<input :name="'producers['+ input.id +'][character_name]'" type="hidden" v-model="input.character_name" :key="i+'character'"/>
																<input :name="'producers['+ input.id +'][is_new]'" type="hidden" v-model="input.is_new" :key="i+'is_new'" v-if="input.is_new"/>
																@error('entity_id')
																<span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
																@enderror
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row part-7-cs">
											<div class="col-12">
												<div class="card">
													<div class="card-header">
														<h5>
															Writer
															<button @click='toggle.writers = !toggle.writers' type="button" class="btn btn-primary" style="float:right;">
																<span v-if="!toggle.writers">Show</span>
																<span v-else>Hide</span>
															</button>
														</h5>
													</div>
													<div class="card-body" id="part_7"  v-if='toggle.writers'>
														<div class="row control-group" v-for="(input, i) in writers">
															<div class="form-group col-lg-8">
																{{ Form::label('name', 'Name') }}
																<div class="input-group mb-3">
																	{{ Form::select(null, $people, $fdata && $fdata->people ? $fdata->people->pluck('name','id')->toArray() : null, ['class' => $errors->has('entity_id') ? 'form-control   is-invalid' : 'form-control ', 'placeholder' =>'Select A Name', 'v-model' => 'input.entity_id', ':name' => "'writers['+ input.id +'][entity_id]'"]) }}
																	<div class="input-group-append">
																		<button @click="addInput(writers, input.id, 5)" class="btn btn-primary" type="button" v-if="i < 1">+Add</button>
																		<button @click="remove(writers, input.id)" class="btn btn-danger" type="button" v-else>-Remove </button>
																	</div>
																</div>
																<input :name="'writers['+ input.id +'][role_id]'" type="hidden" v-model="input.role_id" :key="i+'role'"/>
																<input :name="'writers['+ input.id +'][character_name]'" type="hidden" v-model="input.character_name" :key="i+'character'"/>
																<input :name="'writers['+ input.id +'][is_new]'" type="hidden" v-model="input.is_new" :key="i+'is_new'" v-if="input.is_new"/>
																@error('entity_id')
																<span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
																@enderror
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row part-7-cs">
											<div class="col-12">
												<div class="card">
													<div class="card-header">
														<h5>
															Music Director
															<button @click='toggle.musicians = !toggle.musicians' type="button" class="btn btn-primary" style="float:right;">
																<span v-if="!toggle.musicians">Show</span>
																<span v-else>Hide</span>
															</button>
														</h5>
													</div>
													<div class="card-body" id="part_7"  v-if='toggle.musicians'>
														<div class="row control-group" v-for="(input, i) in musicians">
															<div class="form-group col-lg-8">
																{{ Form::label('name', 'Name') }}
																<div class="input-group mb-3">
																	{{ Form::select(null, $people, $fdata && $fdata->people ? $fdata->people->pluck('name','id')->toArray() : null, ['class' => $errors->has('entity_id') ? 'form-control   is-invalid' : 'form-control ', 'placeholder' =>'Select A Name', 'v-model' => 'input.entity_id', ':name' => "'musicians['+ input.id +'][entity_id]'"]) }}
																	<div class="input-group-append">
																		<button @click="addInput(musicians, input.id, 6)" class="btn btn-primary" type="button" v-if="i < 1">+Add</button>
																		<button @click="remove(musicians, input.id)" class="btn btn-danger" type="button" v-else>-Remove </button>
																	</div>
																</div>
																<input :name="'musicians['+ input.id +'][role_id]'" type="hidden" v-model="input.role_id" :key="i+'role'"/>
																<input :name="'musicians['+ input.id +'][character_name]'" type="hidden" v-model="input.character_name" :key="i+'character'"/>
																<input :name="'musicians['+ input.id +'][is_new]'" type="hidden" v-model="input.is_new" :key="i+'is_new'" v-if="input.is_new"/>
																@error('entity_id')
																<span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
																@enderror
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row part-7-cs">
											<div class="col-12">
												<div class="card">
													<div class="card-header">
														<h5>
															Cinematographer
															<button @click='toggle.cinematographers = !toggle.cinematographers' type="button" class="btn btn-primary" style="float:right;">
																<span v-if="!toggle.cinematographers">Show</span>
																<span v-else>Hide</span>
															</button>
														</h5>
													</div>
													<div class="card-body" id="part_7"  v-if='toggle.cinematographers'>
														<div class="row control-group" v-for="(input, i) in cinematographers">
															<div class="form-group col-lg-8">
																{{ Form::label('name', 'Name') }}
																<div class="input-group mb-3">
																	{{ Form::select(null, $people, $fdata && $fdata->people ? $fdata->people->pluck('name','id')->toArray() : null, ['class' => $errors->has('entity_id') ? 'form-control   is-invalid' : 'form-control ', 'placeholder' =>'Select A Name', 'v-model' => 'input.entity_id', ':name' => "'cinematographers['+ input.id +'][entity_id]'"]) }}
																	<div class="input-group-append">
																		<button @click="addInput(cinematographers, input.id, 7)" class="btn btn-primary" type="button" v-if="i < 1">+Add</button>
																		<button @click="remove(cinematographers, input.id)" class="btn btn-danger" type="button" v-else>-Remove </button>
																	</div>
																</div>
																<input :name="'cinematographers['+ input.id +'][role_id]'" type="hidden" v-model="input.role_id" :key="i+'role'"/>
																<input :name="'cinematographers['+ input.id +'][character_name]'" type="hidden" v-model="input.character_name" :key="i+'character'"/>
																<input :name="'cinematographers['+ input.id +'][is_new]'" type="hidden" v-model="input.is_new" :key="i+'is_new'" v-if="input.is_new"/>
																@error('entity_id')
																<span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
																@enderror
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row part-7-cs">
											<div class="col-12">
												<div class="card">
													<div class="card-header">
														<h5>
															Distributor
															<button @click='toggle.distributors = !toggle.distributors' type="button" class="btn btn-primary" style="float:right;">
																<span v-if="!toggle.distributors">Show</span>
																<span v-else>Hide</span>
															</button>
														</h5>
													</div>
													<div class="card-body" id="part_7"  v-if='toggle.distributors'>
														<div class="row control-group" v-for="(input, i) in distributors">
															<div class="form-group col-lg-8">
																{{ Form::label('name', 'Name') }}
																<div class="input-group mb-3">
																	{{ Form::select(null, $people, $fdata && $fdata->people ? $fdata->people->pluck('name','id')->toArray() : null, ['class' => $errors->has('entity_id') ? 'form-control   is-invalid' : 'form-control ', 'placeholder' =>'Select A Name', 'v-model' => 'input.entity_id', ':name' => "'distributors['+ input.id +'][entity_id]'"]) }}
																	<div class="input-group-append">
																		<button @click="addInput(distributors, input.id, 8)" class="btn btn-primary" type="button" v-if="i < 1">+Add</button>
																		<button @click="remove(distributors, input.id)" class="btn btn-danger" type="button" v-else>-Remove </button>
																	</div>
																</div>
																<input :name="'distributors['+ input.id +'][role_id]'" type="hidden" v-model="input.role_id" :key="i+'role'"/>
																<input :name="'distributors['+ input.id +'][character_name]'" type="hidden" v-model="input.character_name" :key="i+'character'"/>
																<input :name="'distributors['+ input.id +'][is_new]'" type="hidden" v-model="input.is_new" :key="i+'is_new'" v-if="input.is_new"/>
																@error('entity_id')
																<span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
																@enderror
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row part-7-cs">
											<div class="col-12">
												<div class="card">
													<div class="card-header">
														<h5>
															Screenplay
															<button @click='toggle.screenplay = !toggle.screenplay' type="button" class="btn btn-primary" style="float:right;">
																<span v-if="!toggle.screenplay">Show</span>
																<span v-else>Hide</span>
															</button>
														</h5>
													</div>
													<div class="card-body" id="part_7"  v-if='toggle.screenplay'>
														<div class="row control-group" v-for="(input, i) in screenplay">
															<div class="form-group col-lg-8">
																{{ Form::label('name', 'Name') }}
																<div class="input-group mb-3">
																{{-- @dd($fdata->people) --}}
																	{{ Form::select(null, $people, $fdata && $fdata->people ? $fdata->people->pluck('name','id')->toArray() : null, ['class' => $errors->has('entity_id') ? 'form-control   is-invalid' : 'form-control ', 'placeholder' =>'Select A Name', 'v-model' => 'input.entity_id', ':name' => "'screenplay['+ input.id +'][entity_id]'"]) }}
																	<div class="input-group-append">
																		<button @click="addInput(screenplay, input.id, 12)" class="btn btn-primary" type="button" v-if="i < 1">+Add</button>
																		<button @click="remove(screenplay, input.id)" class="btn btn-danger" type="button" v-else>-Remove </button>
																	</div>
																</div>
																<input :name="'screenplay['+ input.id +'][role_id]'" type="hidden" v-model="input.role_id" :key="i+'role'"/>
																<input :name="'screenplay['+ input.id +'][character_name]'" type="hidden" v-model="input.character_name" :key="i+'character'"/>
																<input :name="'screenplay['+ input.id +'][is_new]'" type="hidden" v-model="input.is_new" :key="i+'is_new'" v-if="input.is_new"/>
																@error('entity_id')
																<span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
																@enderror
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row part-7-cs">
											<div class="col-12">
												<div class="card">
													<div class="card-header">
														<h5>
															Add More Roles
															<button @click='toggle.role = !toggle.role' type="button" class="btn btn-primary" style="float:right;">
																<span v-if="!toggle.role">Show</span>
																<span v-else>Hide</span>
															</button>
														</h5>
													</div>
													<div class="card-body" id="part_7"  v-if='toggle.role'>
														{{-- @{{directors}} --}}
														<div class="row control-group" v-for="(input, i) in role">
															<div class="form-group col-12">
																<div class="row">
																	<div class="col-6">
																		<label :for="'role['+ input.id +'][entity_id]'">Name</label>
																		<div class="input-group mb-3">
																			{{ Form::select(null, $people, $fdata && $fdata->people ? $fdata->people->pluck('name','id')->toArray() : null, ['class' => $errors->has('entity_id') ? 'form-control   is-invalid' : 'form-control ', 'placeholder' =>'Select A Name', 'v-model' => 'input.entity_id', ':name' => "'role['+ input.id +'][entity_id]'"]) }}
																		</div>
																	</div>
																	<div class="col-6">
																		<div class="form-group">
																			<label :for="'role['+ input.id +'][role_id]'">Roles Title</label>
																			<div class="input-group">
																				{{ Form::select(null, getOtherRoleArr(), $fdata && $fdata->roles ? $fdata->roles->pluck('name','id')->toArray() : null, ['class' => $errors->has('role_id') ? 'form-control   is-invalid' : 'form-control ', 'v-model' => 'input.role_id', ':name' => "'role['+ input.id +'][role_id]'", 'required' => 'required']) }}
																				<input :name="'role['+ input.id +'][role_id]'" type="hidden" v-model="input.role_id" :key="i+'role'"/>
																				<input :name="'role['+ input.id +'][is_new]'" type="hidden" v-model="input.is_new" :key="i+'is_new'" v-if="input.is_new"/>
																				<div class="input-group-append">
																					<button @click="addInput(role, input.id, 1)" class="btn btn-primary" type="button" v-if="i < 1">+Add</button>
																					<button @click="remove(role, input.id)" class="btn btn-danger" type="button" v-else>-Remove </button>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																@error('role_id')
																<span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
																@enderror
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-6">
												{!! Form::label('potraitimage', 'Potraitimage') !!}
												@isset($fdata->potraitimage)
													<div style="min-height: 100px">
														<img src="{{asset($fdata->potraitimage)}}" height="100px" width="auto" alt="">
													</div>
												@endisset
												{!! Form::file('potraitimage',  ['class' => 'form-control']) !!}
												@error('potraitimage')
												<span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
												@enderror
											</div>
											<div class="form-group col-6">
												{!! Form::label('landscapeimage', 'landscapeimage') !!}
												@isset($fdata->landscapeimage)
													<div style="min-height: 100px">
														<img src="{{asset($fdata->landscapeimage)}}" height="100px" width="auto" alt="">
													</div>
												@endisset
												{!! Form::file('landscapeimage',  ['class' => 'form-control']) !!}
												@error('landscapeimage')
												<span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
												@enderror
											</div>
										</div>
									</div>
								</section>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						@include('admin.pages.seo.seo', ['sdata' => ($fdata && $fdata->seo)?$fdata->seo:null])
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</section>
	</div>
@endsection
@push('customjs')
	<script>
        jQuery(document).ready(function($) {
            $('.myselect2').select2();
        });
        function ShowHide(self) {
            let id = $(self).data('id');
            let name = $(self).text();
            $(self).closest('.card').find('.card-body').toggleClass('hide');

            if (name == 'Show') {
                $(self).html('Hide');
            }
            if (name == 'Hide') {
                $(self).html('Show');
            }
        }
        Vue.component('v-select', VueSelect.VueSelect);
        //let entities = {{json_encode($people)}};
        let entities          =  {!! json_encode(getEntities()) !!};
        let directors         =  {!! json_encode($directors) !!};
        let producers         =  {!! json_encode($producers) !!};
        let casts             =  {!! json_encode($casts) !!};
        let role              =  {!! json_encode($role) !!};
        let writers           =  {!! json_encode($writers) !!};
        let musicians         =  {!! json_encode($musicians) !!};
        let cinematographers  =  {!! json_encode($cinematographers) !!};
        let distributors      =  {!! json_encode($distributors) !!};
        let screenplay        =  {!! json_encode($screenplay) !!};
        new Vue({
            el: '#app',
            data: {
                inputs: [{}],
                directors: directors,
                producers: producers,
                casts: casts,
                role: role,
                writers: writers,
                musicians: musicians,
                cinematographers: cinematographers,
                distributors: distributors,
                screenplay: screenplay,
                toggle: {'directors': true, 'producers': producers[0].entity_id, 'casts': casts[0].entity_id, 'writers': writers[0].entity_id, 'musicians': musicians[0].entity_id, 'cinematographers': cinematographers[0].entity_id, 'distributors': distributors[0].entity_id, 'screenplay': screenplay[0].entity_id, 'role': role[0].role_id,},
                options: []
            },
            methods: {
                addInput(array, id, role_id) {
                    let last = array.slice(-1).pop();
                    array.push({'id': last.id+1, 'entity_id': null, 'role_id': role_id, 'character_name': null, 'is_new': true});
                },
                remove(array, value) {
                    //let index = array.indexOf(value);
                    let index = array.map((el) => el.id).indexOf(value);
                    //pos = entity_type.findIndex(x => x.id === i)
                    if (index > -1) {
                        //alert('Im here');
                        array.splice(index, 1);
                    }
                },
            },
            //name to slug and make every word upper
            mounted() {
                var name = document.getElementById("name");
                var slug = document.getElementById("slug");
                name.addEventListener("change", function () {
                    slug.value = name.value.toLowerCase().replaceAll(" ", "-");
                    name.value = name.value.toLowerCase().split(' ').map(s => s.charAt(0).toUpperCase() + s.substring(1)).join(' ');
                });
            },

        })
	</script>
@endpush
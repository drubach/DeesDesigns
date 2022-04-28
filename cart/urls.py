""" urls - cart. """

#from django.contrib import admin
from django.urls import path
from . import views


urlpatterns = [
    path('', views.view_cart, name='view_cart'),
    path('add_project/', views.add_project, name='add_project'),
    path('remove/<item_id>/', views.remove_from_cart, name='remove_from_cart'),
]

""" urls - cart. """

#from django.contrib import admin
from django.urls import path
from . import views


urlpatterns = [
    path('', views.view_cart, name='view_cart'),
    path('add_project/', views.add_project, name='add_project')
]

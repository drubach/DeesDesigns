""" urls - home. """

#from django.contrib import admin
from django.urls import path
from . import views

urlpatterns = [
    path('', views.all_projects, name='projects'),
    path('<int:project_id>/', views.project_detail, name='project_detail'),
]

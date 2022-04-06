""" Add models for Projects app. """
from django.contrib import admin
from .models import Project, Type

# Register your models here.

class ProjectAdmin(admin.ModelAdmin):
    list_display = (
        'user',
        'type',
        'completed',
        'paid',
        'image',
    )

    ordering = ('user', 'type', 'completed', 'paid')
class TypeAdmin(admin.ModelAdmin):
    list_display = (
        'friendly_name',
        'name',
    )

admin.site.register(Project, ProjectAdmin)
admin.site.register(Type, TypeAdmin)

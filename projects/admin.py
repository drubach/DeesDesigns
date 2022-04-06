***REMOVED*** Add models for Projects app. ***REMOVED***
from django.contrib import admin
from .models import Project, Type

# Register your models here.

class ProjectAdmin(admin.ModelAdmin):
    ***REMOVED*** View for project administration. ***REMOVED***
    list_display = (
        'user',
        'type',
        'completed',
        'paid',
        'image',
    )

    ordering = ('user', 'type', 'completed', 'paid')
class TypeAdmin(admin.ModelAdmin):
    ***REMOVED*** View for Type administration. ***REMOVED***
    list_display = (
        'friendly_name',
        'name',
    )

admin.site.register(Project, ProjectAdmin)
admin.site.register(Type, TypeAdmin)

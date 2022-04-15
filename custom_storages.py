""" Storage location setup for AWS. """
from django.conf import settings
from storages.backends.s3boto3 import S3Boto3Storage

class StaticStorage(S3Boto3Storage):
    """ Setting static file location. """
    #pylint: disable=W0223
    location = settings.STATICFILES_LOCATION


class MediaStorage(S3Boto3Storage):
    """ Setting media file location. """
    #pylint: disable=W0223
    location = settings.MEDIAFILES_LOCATION

<?php

/**
 *	This file contains all empty exception declarations. These allow for
 *	specific errors to catch()
 */

/**
 *	APIException is raised whenever an error occurs while processing or
 *	preparing the API envelope.
 */
class APIException extends Exception {}

/**
 *	QueryException is raised on any error related to queries such as
 *	malformed or ambiguous statements, empty bind arrays, etc.
 */

class QueryException extends Exception {}

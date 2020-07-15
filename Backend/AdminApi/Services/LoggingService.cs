﻿using Microsoft.AspNetCore.Http;
using Microsoft.Extensions.Logging;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace AdminApi.Services
{
    public interface ILoggingService
    {
        public Task Invoke(HttpContext context);
    }

    public class LoggingService : ILoggingService
    {
        private readonly RequestDelegate _next;
        private readonly ILogger _logger;

        public LoggingService(RequestDelegate next, ILoggerFactory loggerFactory)
        {
            _next = next;
            _logger = loggerFactory.CreateLogger<LoggingService>();
        }

        public async Task Invoke(HttpContext context)
        {
            try
            {
                await _next(context);
            }
            finally
            {
                var zone = TimeZoneInfo.FindSystemTimeZoneById("Australia/Perth");
                var now = TimeZoneInfo.ConvertTimeFromUtc(DateTime.UtcNow, zone).ToString("dd/MM/yyyy hh:mm:ss tt");

                _logger.LogInformation(
                        "{dateTime} - Request from {IP}: {method} {url}{query} => {statusCode}",
                        now,
                        context.Request?.HttpContext.Connection.RemoteIpAddress,
                        context.Request?.Method,
                        context.Request?.Path.Value,
                        context.Request?.QueryString,
                        context.Response?.StatusCode
                    );
            }
        }
    }
}
